<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private function getUserAunthentication()
    {
        return auth()->user() ?: response()->json(['error' => 'User not authenticated'], 401);
    }

    public function getListHomework() {
        $student = $this->getUserAunthentication();

        $homeworks = Homework::where('student_id', $student->id)->get();

        if($homeworks->count() > 0) {
            return response()->json([
                'status' => 200,
                'homeworks' => $homeworks
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No record found'
            ], 404);
        }
    }

    public function submitHomework(Request $request, int $id) {
        $this->getUserAunthentication();

        $request->validate([
            'status' => 'required'
        ]);

        $homework = Homework::find($id);

        if($homework) {
            Homework::where('id', $id)->update(['status' => $request->input('status')]);

            return response()->json(['message' => 'Student info updated succesfully.'], 200);
        } else {
            return response()->json(['error' => 'Homework not found.'], 404);
        }
    }
}
