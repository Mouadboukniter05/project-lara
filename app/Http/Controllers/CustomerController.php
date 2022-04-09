<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Session;
//use Session;
class CustomerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.customers')->with('customers',$customers);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'cust_f_name' => 'required',
            'cust_l_name' => 'required',
            // 'cust_status'       => 'required',
            'cust_adress'       => 'required',
            'cust_phone' => 'required|numeric|unique:customers',
            'cust_email'    => 'required|email|unique:customers',
            
    
        ]) ;
        $cust_new = new Customer;
        $cust_new ->cust_f_name = $request->cust_f_name;
        $cust_new ->cust_l_name = $request->cust_l_name;
        $cust_new ->cust_phone = $request->cust_phone;
        $cust_new ->cust_email = $request->cust_email;
        // $cust_new ->cust_status = $request->cust_status;
        $cust_new ->cust_adress = $request->cust_adress;
        $cust_new->save() ;
        Session::flash('success', 'Customer Created') ;
        return redirect()->route('customer.show') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_cust = Customer::find($id);
        return view('customer.edit')->with('edit_cust',$edit_cust);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_cust =  Customer::find($id);
        $update_cust ->cust_f_name = $request->cust_f_name;
        $update_cust ->cust_l_name = $request->cust_l_name;
        $update_cust ->cust_phone = $request->cust_phone;
        $update_cust ->cust_email = $request->cust_email;
        // $update_cust ->cust_status = $request->cust_status;
        $update_cust ->cust_adress = $request->cust_adress;
        $update_cust->save() ;
        Session::flash('success', 'Customer was sucessfully updated') ;
        return redirect()->route('customer.show') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
