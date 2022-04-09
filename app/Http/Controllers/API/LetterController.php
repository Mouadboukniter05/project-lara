<?php
namespace App\Http\Controllers\API;
//use App\Message;
use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use App\Letter;
use Validator;

class LetterController extends BaseController
{

    public function index()
 {
     $messages = Letter::all();
    return response()->json($messages->toArray());
 }


    ////////////////////////////////////////

    public function sendMessage(Request $request)
    {
        $input = $request->all();
        $validator =
        Validator::make($input,
    [
        'id_client' => 'required',
         'message' =>'required|string|max:255' ,
         'post'=>'required|string',
         'email'=>'required|string|email',
         'whoishe'=>'required',
         'subject'=>'required',
    ]
    );

    if($validator->fails()){
        return response()->json($validator->errors());
        }
        $message = Letter::create($input);
        //$success['token'] = $message->createToken('MyApp')->accessToken;

        return response()->json($message->toArray());
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function showMessages($id)
    {
        $messages = Letter::where('id_client',$id)->orderBy('created_at', 'desc')->get();

    if( is_null($messages) ){
        return response()->json($validator->errors());
        }
        //$messages->read=1;
        //$messages->save();
        return response()->json($messages->toArray());
    }

////////////////////////////////////////////////////////////////////////////////



}




/*
f($validator->fails()){
        return response()->json($validator->errors());
        }
            User::create([
                'name'  => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'prenom' => $request->get('prenom'),
                'tele' => $request->get('tele'),
                'sexe' => $request->get('numerocompte'),
                'cin' => $request->get('cin'),
                //'adresse' => $request->get('adresse'),
                'post' => $request->get('post'),
            ]);

            $che = User::first();
        $token = JWTAuth::fromUser($che);
            return Response::json(compact('token'));
            */
