<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendSuccess($message = null,$data = [],$status = null)
    {
        return response()->json([
            "message" => $message,
            "data" => $data 
        ], $status);
    }   
}
