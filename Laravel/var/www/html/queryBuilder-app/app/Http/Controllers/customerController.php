<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    public function insert_customer(){
        return view('insert_customer');
    }

    public function insert(Request $request){

        $name = $request->input('name');
        $age = $request->input('age');
        $place = $request->input('place');
        $phone = $request->input('phone');
        $salary = $request->input('salary');
        
    

        //insert
        DB::insert("insert into customers(name,age,place,phone,salary) values(?,?,?,?,?)",[$name,$age,$place,$phone,$salary]);

        return 'Record inserted successfully ID <br><a href="/">Back to form</a>';
    }
}
