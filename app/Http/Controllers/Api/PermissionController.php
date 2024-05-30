<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    //create
    public function store(Request $request)
    {

        $request->validate([
            'date_permission' => 'required',
            'reason' => 'required',
        ]);

        // check if permission already exist
        $permission = Permission::find($request->id);
        $status = 200; $message = 'Data updated successfully.';
        if(!$permission) {
            $status = 201; $message = 'Data created successfully.';
            $permission = new Permission();
        }

        $permission = new Permission();
        $permission->user_id = $request->user()->id;
        $permission->date_permission = $request->date_permission;
        $permission->reason = $request->reason;
        $permission->is_approved  = 0;
        $permission->save();

        //image
        if ($request->hasFile('image')) {

            //delete old image
            $destination = 'public' . $permission->image;
            if(file_exists($destination)) {
                unlink($destination);
            }

            $image = $request->file('image');
            $image->storeAs('public/permission', $permission->id . '.' . $image->extension());
            $permission->image = '/permission/' . $permission->id . '.' . $image->extension();
            $permission->save();

        }

        return response([
            'permission' => $permission,
            'message' => $message,
            'status' => 'success'
        ], $status);
    }


}
