<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contact.contacts')->with('contacts',$contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            'cont_name' => 'required',
            'cont_message' => 'required',
            'cont_email'    => 'required|email',
            
    
        ]) ;
        $cont_new = new Contact;
        $cont_new ->cont_name = $request->cont_name;
        $cont_new ->cont_email = $request->cont_email;
        $cont_new ->cont_message = $request->cont_message;
        $cont_new->save();
        // return view('index');
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacts = Contact::findOrfail($id);
        return view('contact.show')->with('contacts',$contacts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delet_cont = Contact::find($id);
        $delet_cont ->delete();
        Session::flash('success', 'Message was deleted') ;
        return redirect()->back();
    }

}
