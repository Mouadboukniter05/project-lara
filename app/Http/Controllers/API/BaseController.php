<?php
namespace App\Http\Controllers\API;
//use App\Message;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result , $message){
        $response =[
            'success'=>true,
            'data'=>$result,
            'message'=>$message
        ];
        return response()->json($response,200);
    }


    public function sendError($error , $errorsmessage=[]){
        $response =[
            'success'=>false,
            'message'=>$error
        ];
        if (!empty($errormessage)) {
            $response['data'] = $errorsmessage;
        }
        return response()->json($response,404);
    }


}
