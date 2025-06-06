<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function students_list()
    {
        return Student::all();
    }
    function addStudent(Request $request)
    {

        $rules = array(
            'name' => 'required|min:3|max:10',
            'email' => 'required|email',
            'phone' => 'required|min:9',
        );

        $validator = Validator::make(
            $request->all(),
            $rules
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            $student  = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            if ($student->save()) {
                return response()->json(['message' => 'Student Added Successfully']);
            } else {
                return response()->json(['message' => 'Failed to Add Student']);
            }
        }
    }

    function updateStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return response()->json(['message' => 'Student Updated Successfully']);
        } else {
            return response()->json(['message' => 'Failed to Update Student']);
        }
    }

    public function deleteStudent($id)
    {
        $student = Student::destroy($id);
        if ($student) {
            return response()->json(['message' => 'Student Deleted Successfully']);
        } else {
            return response()->json(['message' => 'Failed to Delete Student'], 404);
        }
    }

    public function searchStudent($name)
    {
        $student = Student::where('name', 'like', '%' . $name . '%')->get();
        if ($student->isNotEmpty()) {
            return response()->json(['message' => $student], 200);
        } else {
            return response()->json(['message' => 'Student Not Found'], 404);
        }
    }
}
