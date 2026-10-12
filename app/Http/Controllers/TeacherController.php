<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function list()
    {
        // Mengambil semua data siswa dengan tipe user 2 dan menyertakan nama kelas
        $getRecords = User::getTeacher();
        return view('admin.teacher.list', compact('getRecords'));
    }

    public function add()
    {
        // Mengambil semua kelas
        $data['getClass'] = ClassModel::getClass();
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mobile_number' => 'nullable|string|max:255',
            'admission_date' => 'required|date',
            'marital_status' => 'required|integer',
            'address' => 'required|string|max:255', // Menggunakan aturan 'string' untuk 'address'
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|integer', 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->marital_status = (int) $request->marital_status;
        $teacher->address = trim($request->address);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->admission_date = $request->admission_date;
    
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $teacher->profile_pic = $filename;
        }
    
        $teacher->status = (int) $request->status;
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();
    
        return redirect()->route('admin.teacher.list')->with('success', 'Teacher added successfully.');
    }
    

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        $data['getClass'] = ClassModel::getClass();
        return view('admin.teacher.edit', compact('teacher', 'data'));
    }

    public function update(Request $request, $id)
    {
        // Find the teacher by ID
        $teacher = User::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $teacher->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->id,
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'religion' => 'nullable|string|max:255',
            'address' => 'required|string|max:255', // Menggunakan aturan 'string' untuk 'address'
            'mobile_number' => 'nullable|string|max:255|unique:users,mobile_number,' . $teacher->id,
            'admission_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update teacher data
        $teacher->name = trim($request->name);
        $teacher->email = trim($request->email);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->religion = trim($request->religion);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->admission_date = $request->admission_date;
        $teacher->address = trim($request->address);


        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $teacher->profile_pic = $filename;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return redirect()->route('admin.teacher.list')->with('success', 'teacher updated successfully.');
    }

    public function delete($id)
    {
        $teacher = User::findOrFail($id);

        if ($teacher->profile_pic && file_exists(public_path('uploads/profile_pics/' . $teacher->profile_pic))) {
            unlink(public_path('uploads/profile_pics/' . $teacher->profile_pic));
        }

        $teacher->delete();

        return redirect()->route('admin.teacher.list')->with('success', 'Teacher deleted successfully.');
    }
}
