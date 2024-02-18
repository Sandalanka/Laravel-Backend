<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result , $message){
        $response=[
            'success' => true,
            'data'    => $result
        ];
        if(!empty($message)){
            $response['message'] =$message;
        }
        return response()->json($response, 200);
    }

    public function sendError($error)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, 400);
    }
}
