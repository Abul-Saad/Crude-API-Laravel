<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customer = Customer::all();
        if($customer)
        {
            return response()->json([
                'status'=> 'success',
                'message'=> 'Customer Data Find',
                'Data'=> $customer
            ]);
        }else
        {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Customer Data Not Find',
            ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $rules = array(
            'name'=> 'required',
            'email'=> 'email | required'
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
    
            if($customer->save())
            {
                return response()->json([
                    'status'=> 'success',
                    'message'=> 'This is Create Functions',
                    'data'=> $customer
                ]);
            }else
            {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Customer Create Failed',
                ],404);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $customer = new Customer();
        $customer->name=$request->name;
        $customer->email=$request->email;

        if($customer->save())
        {
            return response()->json([
                'status'=> 'success',
                'message'=> 'This is Store Functions',
                'data'=> $customer
            ]);
        }else
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Customer Store Failed',
            ],404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $customer = Customer::find($id);

        if($customer)
        {
            return response()->json([
                'status'=> 'success',
                'message'=> 'The Specified Customer Show',
                'data'=> $customer
            ]);
        }else
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Not show Specific Customer'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $customer = Customer::find($id);

        $customer->name=$request->name;
        $customer->email=$request->email;

        if($customer->save())
        {
            return response()->json([
                'status'=> 'success',
                'message'=> 'Update Customer Successfully',
                'data'=> $customer
            ]);
        }else
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Updated Failed',
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::destroy($id);

        if($customer)
        {
            return response()->json([
                'status'=> 'success',
                'message'=> 'Deleted Successfully',
                'data'=> $customer
            ]);
        }else
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Deleted Failled',
                'data'=> $customer
            ],404);
        }
    }
}
