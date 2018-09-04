<?php

namespace App\Http\Controllers;

use App\SmsQueue;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    public function send(Request $request) {
        $v = Validator::make($request->all(), [
            'message' => 'required',
            'time' => 'required'
        ]);

        if ($v->fails()) {
            return response($v->errors(), 422);
        }

        try {
            $time = Carbon::parse($request->input('time'));
        } catch (\Exception $e) {
            return response(['error' => 'Incorrect time format'], 422);
        }

        if ($time <= Carbon::now()) {
            return response(['error' => 'Wrong time'], 422);
        }

        SmsQueue::create($request->only('message', 'time'));

        return response('success');
    }
}
