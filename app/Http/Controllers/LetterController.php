<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Letter;
use App\Customer;
use App\Http\Controllers\DB;

class LetterController extends Controller
{
    public function index()
    {
        
        $customers =  Customer::all() ; 
        $letters  = Letter::orderBy('created_at', 'desc')->paginate(10) ;  
       
        return view('message.messages')->with('messages', $letters) 
                                 ->with('listcust',$customers ) ;
                               
    }

   


    public function create()
    {
        $message = Letter::all()  ;
        $customers = Customer::all() ;
        return view('message.create')->with('messages', $message) 
                                  ->with('customers', $customers) ;        
    }

    public function store(Request $request)
    {
        
        
       
            $this->validate( $request, [
                'email'       => 'required',           
                'message'    => 'required',
                'title'    => 'required'
            ]) ;

            $customers = Customer::all();
            foreach ($customers as $l) {
                if($l->cust_email == $request->email){
                    $id = $l->id;
                break;
                }
                
            }
            $message = new Letter();
            $message->user_id =Auth::user()->id;
            $message->id_client =$id;
            $message->email = Auth::user()->email;
            $message->whoishe = 'manager';
            $message->post = 'manager';
            $message->message = $request->message;
            $message->subject = $request->title;
            $message->save();
            // Then save files using the newly created ID above
            
            Session::flash('success', 'Message send') ;
            return redirect()->route('message.show') ; 
        }

    public function destroy($id)
    {
        $delete_message = Letter::find($id) ;
        $delete_message->delete() ;
        Session::flash('success', 'Message was deleted') ;
        return redirect()->back();
    }
    public function showmess($id){
        $message = Letter::find($id);
        $customers = Customer::all();
        return view('message.show')->with('message',$message);
    }
       
    

}
