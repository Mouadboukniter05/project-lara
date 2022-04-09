<?php
namespace App\Http\Controllers\API;
//use App\Message;
use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Projet;
use Validator;

class ClientController extends BaseController
{
    public function indexall($id)
    {
        $projets = Projet::where('customer_id',$id)->orderBy('created_at', 'desc')->get();
       return response()->json($projets->toArray());
    }
    /////////////////////////////////////////////
    public function hesAfterUpdate($id)
 {
     $Customer = Customer::find($id);
    return response()->json($Customer->toArray());
 }
    ////////////////////////////////////////////////////
    public function index()
 {
     $Customers = Customer::all();
    return response()->json($Customers->toArray());
 }
 ////////////////////////////////////////////////////////////////////
 public function updateInfoClient(Request $request,$id)
    {
        $input = $request->all();
        $validator =
        Validator::make($input,
    [   
        'cust_status'=>'required|string|min:5|max:255',
        'cust_adress'=>'required|string|min:5|max:255',
        'cust_phone'=>'required|string|min:10|max:10',
        'cust_email'=>'required|string|min:5|max:255|email',
    ]
    );

    if($validator->fails()){
    return response()->json($validator->errors());
        }
        $customer = Customer::find($id);
        $customer->cust_f_name=$input['cust_f_name'];
        $customer->cust_l_name=$input['cust_l_name'];
        $customer->cust_status=$input['cust_status'];
        $customer->cust_adress=$input['cust_adress'];
        $customer->cust_phone=$input['cust_phone'];
        $customer->cust_email=$input['cust_email'];
        $customer->save();
        return  response()->json($customer->toArray());
    }
    //////////////////////////////////////////////////////////////
   /* public function updatePasswClient(Request $request,$id)
    {

        $input = $request->all();
        $validator =
        Validator::make($input,
    [
        'password'=>'required',
    ]
    );

    if($validator->fails()){
        return response()->json($validator->errors());
        }
        $customer=Customer::find($id);
        $customer->password=bcrypt($input['password']);
        $customer->paschange=1;
        $customer->save();
        return response()->json($client->toArray());
    }*/

}
