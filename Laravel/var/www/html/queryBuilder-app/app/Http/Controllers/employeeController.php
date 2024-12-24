<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use Illuminate\Support\Facades\DB;

class employeeController extends Controller
{
    //
    public function show()
    {
       $employees = employee::paginate(5);
        return view('layout.welcome', compact('employees'));
    }

    public function queryBuilder(){
        $wherestmts = DB::table('employees')->where('age',14)->get();
        return view('wherestmtpage',compact('wherestmts'));
    }
}



// $result=DB::table('person')->select('name')->get();
//         $result1=DB::table('person')
//                 ->where('name','=','balaji')->get();

//         $result2=DB::table('person')
//                 ->where('name','=','balaji')
//                 ->orWhere('rollno','=','10')
//                 ->get();

//         $result3=DB::table('person')
//                 ->where('name','=','balaji')
//                 ->orWhere('rollno','>','50')
//                 ->get();

//         $result3=DB::table('person')
//                 ->where('name','=','balaji')
//                 ->orWhere('rollno','>','50')
//                 ->get();
                
//         $result4=DB::table('person')
//                 ->where('name','like','S%')
//                 ->get();

//         $result5=DB::table('person')
//                 ->whereBetween('id',[3,13])
//                 ->where('name','like','S%')
//                 ->get();

//         $result5=DB::table('person')
//                 ->whereTime('created_at','05:18:57')
//                 ->where('name','like','S%')
//                 ->get();

//         $result6=DB::table('person')
//                 ->orderBy('age','asc')
//                 ->get();

//         $result7=DB::table('person')
//                 ->limit(10)
//                 ->get();

//         $result8=DB::table('person')
//                 ->max('age');        //also use min,count,avg,sum
        
//         $result9=DB::table('person')
//                 ->count('person');

// //CRUD
//         DB::table('person')->insert([
//             'name'=>'alfan',
//             'rollno'=>'054',
//             'city'=>'knkmri',
//             'age'=>21,
//             'created_at'=>now(),
//             'updated_at'=>now()
//         ]);

//         DB::table('person')
//                 ->where('id',42)
//                 ->update([
//                     'city'=>'thirunelveli'
//                 ]);
        
//         DB::table('person')
//                 ->where('id',9)
//                 ->delete();

//         return "";
//         // dump($result3);
//         // foreach($result3 as $res){
//         //     echo $res->name."=";
//         //     echo $res->rollno."<br>";
//         // }
