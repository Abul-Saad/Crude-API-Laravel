<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class CustomerController extends Controller
{
    //

    function listApi()
    {
        return Customer::all();
    }
    function addApi(Request $request)
    {
        $rules = array(
            'name'=> 'required',
            'email'=> 'required| email',
        );

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            return $validation->errors();
        }
        else
        {
            $customer = new Customer();
    
            $customer->name=$request->name;
            $customer->email=$request->email;
            $customer->save();
    
            if($customer)
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer Added Successfully',
                    'customer' => $customer
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Customer Added Failed',
                ],500);
            }

        }
    }
    function updateApi(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->name=$request->name;
        $customer->email=$request->email;
        
        if($customer->save())
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Updated Successfully',
                'customer' => $customer
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Updated Failed',
            ],500);
        }
    }
    function deleteApi($id)
    {
        $customer = Customer::destroy($id);
        if($customer)
        {
            return response()->json([
                'status'=>'success',
                'message'=>'Deleted Succesfully'
            ]);
        }else
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Deleted Failed'
            ]);
        }

    }
}
