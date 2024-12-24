<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student; // Ensure you have the correct casing

class StudentController extends Controller
{
    public function create(){
        return view('create_student');
    }

    public function store(Request $request){
        $student = new Student;
        $student->name = $request->input('name');
        $student->department = $request->input('department');
        $student->age = $request->input('age');
        $student->save();

        return 'Student created successfully. ID: '.$student->id.'<br><a href="/">Back to form</a><br><a href="/list">View students records</a>';
    }

    public function list(Request $request){
        $students = student::paginate(5);

        if($request->ajax()){
            return view('layout.page', ['students' => $students]); // Return only the table part for AJAX
        }
        return view('student_list', ['students' => $students]);
    }

    // public function page() {
    //     $students = student::paginate(5);
    // }

}

