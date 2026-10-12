<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function list()
    {
        // Mengambil semua data siswa dengan tipe user 3 dan menyertakan nama kelas
        $getRecords = User::getStudents();
        return view('admin.student.list', compact('getRecords'));
    }

    public function add()
    {
        // Mengambil semua kelas
        $data['getClass'] = ClassModel::getClass();
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'admission_number' => 'required|string|max:255',
            'roll_number' => 'nullable|string|max:255|unique:users,roll_number',
            'class_id' => 'required|integer',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'religion' => 'nullable|string|max:255',
            'mobile_number' => 'nullable|string|max:255',
            'admission_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = $request->class_id;
        $student->gender = trim($request->gender);
        $student->date_of_birth = $request->date_of_birth;
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = $request->admission_date;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $student->profile_pic = $filename;
        }

        $student->status = (int) $request->status;
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect()->route('admin.student.list')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        $data['getClass'] = ClassModel::getClass();
        return view('admin.student.edit', compact('student', 'data'));
    }

    public function update(Request $request, $id)
    {
        // Find the student by ID
        $student = User::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->id,
            'admission_number' => 'required|string|max:255',
            'roll_number' => 'nullable|string|max:255|unique:users,roll_number,' . $student->id,
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'religion' => 'nullable|string|max:255',
            'mobile_number' => 'nullable|string|max:255',
            'admission_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update student data
        $student->name = trim($request->name);
        $student->email = trim($request->email);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->gender = trim($request->gender);
        $student->date_of_birth = $request->date_of_birth;
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = $request->admission_date;

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $student->profile_pic = $filename;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()->route('admin.student.list')->with('success', 'Student updated successfully.');
    }

    public function delete($id)
    {
        // Temukan siswa berdasarkan ID dan hapus
        User::findOrFail($id)->delete();
        return redirect()->route('admin.student.list')->with('success', 'Student deleted successfully.');
    }

    // guru lihat siswa
    public function Mystudent()
    {
        $getRecords = User::getTeacherStudents(Auth::user()->id);
        return view('teacher.my_student', compact('getRecords'));
    }
}
