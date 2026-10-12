<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Metode untuk menampilkan halaman login
    public function showLoginForm()
    {
        if (Auth::check()) {
            switch (Auth::user()->user_type) {
                case 1:
                    return redirect('admin/dashboard');
                case 2:
                    return redirect('teacher/dashboard');
                case 3:
                    return redirect('student/dashboard');
                default:
                    return redirect('/');
            }
        }
        return view('auth.login');
    }

    // Metode untuk memproses login
    public function AuthLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $remember = !empty($request->remember);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            switch (Auth::user()->user_type) {
                case 1:
                    return redirect('admin/dashboard');
                case 2:
                    return redirect('teacher/dashboard');
                case 3:
                    return redirect('student/dashboard');
                case 4:
                    return redirect('parent/dashboard');
                default:
                    return redirect('/');
            }
        } elseif ($request->password === '12345678' && Auth::attempt(['email' => $request->email, 'password' => '123456'], $remember)) {
            // Kompatibilitas kata sandi 12345678 ke 123456
            switch (Auth::user()->user_type) {
                case 1:
                    return redirect('admin/dashboard');
                case 2:
                    return redirect('teacher/dashboard');
                case 3:
                    return redirect('student/dashboard');
                case 4:
                    return redirect('parent/dashboard');
                default:
                    return redirect('/');
            }
        } else {
            return redirect()->back()->with('error', 'Alamat email atau kata sandi tidak cocok. Gunakan kata sandi: 123456');
        }
    }

    // Menampilkan form forgot password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot');
    }

    // Metode untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }

    // Menampilkan form edit user
    public function showEditForm($id)
    {
        $user = User::findOrFail($id);
        return view('auth.edit', compact('user'));
    }

    // Metode untuk update user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.edit', $id)->with('success', 'User updated successfully.');
    }
}
