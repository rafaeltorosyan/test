<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/3/18
 * Time: 10:19 PM
 */

namespace App\Services;


use App\Log;

class DbLog
{

    public static function error($message) {
        Log::create([
            'message' => $message,
            'type' => 'error'
        ]);
    }

    public static function info($message) {
        Log::create([
            'message' => $message,
            'type' => 'info'
        ]);
    }

    public static function debug($message) {
        Log::create([
            'message' => $message,
            'type' => 'debug'
        ]);
    }
}
