<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    private function getUserAunthentication()
    {
        return Auth::user()->isTeacher() ? auth()->user() : null;
    }

    public function createHomework(Request $request)
    {
        $teacher = $this->getUserAunthentication();

        if(is_null($teacher)) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $request->validate([
            'teacher_name' => 'required',
            'student_name' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date_format:d-m-Y'
        ]);

        $student = null;
        $studentName = $request->input('student_name');
        if ($studentName !== null) {
            $student = User::where('name', $studentName)->first();
            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }
        }
        
        try {
            $dueDate = \DateTime::createFromFormat('d-m-Y', $request->input('due_date'))->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid due_date format'], 400);
        }

        $homework = Homework::create([
            'teacher_id' => $teacher->id,
            'student_id' => $student ? $student->id : null,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $dueDate,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Homework created successfully',
            'data' => [
                'homework' => $homework,
            ]
        ], 201);
    }

    public function updateAssignedHomework(Request $request)
    {
        $teacher = $this->getUserAunthentication();

        if(is_null($teacher)) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $data = $request->all();

        foreach ($data['homeworks'] as $homework) {
            $title = $homework['title'];
            $description = $homework['description'];
            $dueDate = \DateTime::createFromFormat('d-m-Y', $homework['due_date'])->format('Y-m-d');
            $status = $homework['status'];
            $teacher = User::where('name', $homework['teacher_name'])->first();

            // Extract students details
            $studentsData = $homework['students'];

            foreach ($studentsData as $studentData) {
                $student = User::where('name', $studentData['name'])->first();

                $homework = Homework::create([
                    'teacher_id' => $teacher->id,
                    'student_id' => $student->id,
                    'title' => $title,
                    'description' => $description,
                    'due_date' => $dueDate,
                    'status' => $status
                ]);
            }
        }

        $assignedHomework = Homework::where('teacher_id', $teacher->id)
            ->with('student')
            ->get();

        return response()->json([
            'message' => 'Homework assigned successfully',
            'data' => $assignedHomework
        ], 200);
    }
}