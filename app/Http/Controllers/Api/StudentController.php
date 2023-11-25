<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private function getUserAunthentication()
    {
        return Auth::user()->isStudent() ? auth()->user() : null;
    }

    public function getListHomework() {
        $student = $this->getUserAunthentication();

        if(is_null($student)) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $homeworks = Homework::where('student_id', $student->id)->get();

        if($homeworks->count() > 0) {
            return response()->json(['homeworks' => $homeworks], 200);
        } else {
            return response()->json(['message' => 'No record found'], 404);
        }
    }

    public function submitHomework(Request $request, int $id) {
        $student = $this->getUserAunthentication();

        if(is_null($student)) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

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
