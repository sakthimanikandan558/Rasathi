<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\employee;
use App\Models\order;
use Illuminate\Http\Request;

class orderController extends Controller
{

    public function create(){
        $employee=employee::all();
        $customer=customer::all();

        return view('create_order',compact('employee','customer'));
    }

    public function store(Request $request){

        $request->validate([
            'customer_id' => 'required|exists:customer,id',
            'employee_id' => 'required|exists:employee,id',
            'product' => 'required|string',
        ]);


        order::create($request->all());
        return redirect()->back()->with('success', 'Order created successfully!');
    }

}
