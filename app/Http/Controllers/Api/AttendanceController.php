<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //check in
    public function checkIn(Request $request)
    {
        //validate lat and long
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        //save new attendance
        $attendance = new Attendance();
        $attendance->user_id = $request->user()->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->latlon_in = $request->latitude . ',' . $request->longitude;
        $attendance->save();

        return response()->json([
            'message' => 'Checkin success',
            'status' => 'success',
            'attendance' => $attendance,
        ], 200);
    }

    //check out
    public function checkOut(Request $request)
    {
        //validate lat and long
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        //get last attendance
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->orderBy('id', 'desc')
            ->first();

        //check if attendance is exist
        if (!$attendance) {
            return response()->json([
                'message' => 'Checkin not found, please checkin first',
                'status' => 'error',
            ], 404);
        }

        //update attendance
        $attendance->time_out = date('H:i:s');
        $attendance->latlon_out = $request->latitude . ',' . $request->longitude;
        $attendance->save();

        return response()->json([
            'message' => 'Checkout success',
            'status' => 'success',
            'attendance' => $attendance,
        ], 200);
    }
}
