<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::OrderBy("id", "DESC")->paginate(10);

        return response()->json($students, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $student = Student::create($input);

        return response()->json($student, 200);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        return response()->json($student, 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        $student->fill($input);
        $student->save();

        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        $student->delete();
        $message = ['message' => 'deleted successfully', 'student_id' => $id];

        return response()->json($message, 200);
    }
}
