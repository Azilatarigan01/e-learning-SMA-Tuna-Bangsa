<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // Show account form based on user type
    public function showMyAccountForm()
    {
        $user = Auth::user();

        if ($user->user_type == 1) {
            return view('admin.my_account', compact('user'));
        } elseif ($user->user_type == 2) {
            return view('teacher.my_account', compact('user'));
        } elseif ($user->user_type == 3) {
            return view('student.my_account', compact('user'));
        }

        return redirect()->back()->with('error', 'User type not recognized.');
    }

    // Update account information for Admin
    public function updateAdminAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validateAdmin($request, $user);
        $this->updateUser($user, $request);

        return redirect()->back()->with('success', 'Admin account updated successfully.');
    }

    // Update account information for Teacher
    public function updateTeacherAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validateTeacher($request, $user);
        $this->updateUser($user, $request);

        return redirect()->back()->with('success', 'Teacher account updated successfully.');
    }

    // Update account information for Student
    public function updateStudentAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validateStudent($request, $user);
        $this->updateUser($user, $request);

        return redirect()->back()->with('success', 'Student account updated successfully.');
    }

    // Common update logic for all users
    private function updateUser(User $user, Request $request)
    {
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->gender = trim($request->gender);
        $user->address = trim($request->address);
        $user->date_of_birth = $request->date_of_birth;
        $user->mobile_number = trim($request->mobile_number);

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $user->profile_pic = $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
    }

    // Show Change Password Form
    public function showChangePasswordForm()
    {
        $user_type = Auth::user()->user_type;
        return view('admin.profile.change_password', compact('user_type'));
    }

    // Process Change Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi saat ini tidak cocok.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
    }

    // Validation logic for Admin
    private function validateAdmin(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:255|unique:users,mobile_number,' . $user->id,
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    }

    // Validation logic for Teacher
    private function validateTeacher(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:255|unique:users,mobile_number,' . $user->id,
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    }

    // Validation logic for Student
    private function validateStudent(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:255|unique:users,mobile_number,' . $user->id,
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    }
}
