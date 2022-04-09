<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\User;

class MessageController extends Controller
{
    public function index()
    {
        
        $users =  User::all() ; 
        $message  = Message::orderBy('created_at', 'desc')->paginate(10) ;  
       
        return view('message.boit_messages')->with('messages', $message) 
                                 ->with('users', $users ) ;
                               
    }

    public function index_in()
    {
        
        $users =  User::all() ; 
        $message  = Message::orderBy('created_at', 'desc')->paginate(10) ;  
       
        return view('message.boit_messages_in')->with('messages', $message) 
                                 ->with('users', $users ) ;
                               
    }


    // public function create()
    // {
    //     $message = Message::all()  ;
    //     $users = User::all() ;
    //     return view('message.create')->with('messages', $message) 
    //                               ->with('users', $users) ;        
    // }

    public function store(Request $request)
    {
        
        
       
            $this->validate( $request, [
                'email'       => 'required',           
                'message'    => 'required'
            ]) ;

            
            $message = Message::create([
                'user_id'    => Auth::user()->id,
                'message' => $request->message,
                'email'       => $request->email,
                
            ]);

            // Then save files using the newly created ID above
            
            Session::flash('success', 'Message send') ;
            return redirect()->route('boit_message.show') ; 
        }

    public function destroy($id)
    {
        $delete_message = Message::find($id) ;
        $delete_message->delete() ;
        Session::flash('success', 'Message was deleted') ;
        return redirect()->back();
    }

}
