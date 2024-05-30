<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login(Request $request) {

        $loginData = $request->validate([

            'email' => 'required|email',
            'password' => 'required'

        ]);

        $user = User::where('email', $loginData['email'])->first();

        //cek user exist
        if(!$user) {
            return response([
                'message' => 'These credentials do not match our records.',
                'status' => 'failed'
            ], 401);
        }

        //cek password
        if(!Hash::check($loginData['password'], $user->password)) {
            return response([
                'message' => 'Invalid password',
                'status' => 'failed'
            ], 401);
        }

        // create token
        $token = $user->createToken('auth_token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
            'message' => 'Login successfull.',
            'status' => 'success'
        ], 200);
    }

    //logout
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Logout successfull.',
            'status' => 'success'
        ], 200);
    }

    //update image profile and face_embedding
    public function updateProfile(Request $request) {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'face_embedding' => 'required'
        ]);

        $user = $request->user();
        $user->face_embedding = $request->face_embedding;

        if($request->hasFile('image_url')) {

            //delete old image
            $destination = 'public' . $user->image_url;
            if(file_exists($destination)) {
                unlink($destination);
            }

            //upload new image
            $image = $request->file('image_url');
            $image->storeAs('public/users', $user->id . '.' . $image->extension());
            $user->image_url = '/users/' . $user->id . '.' . $image->extension();

        }

        $user->save();

        return response([
            'message' => 'Update profile successfull.',
            'status' => 'success',
            'user' => $user
        ], 200);
    }
}
