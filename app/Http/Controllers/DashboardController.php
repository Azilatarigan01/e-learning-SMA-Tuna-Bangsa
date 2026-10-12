<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->user_type == 1)
        {
            return view('admin.dashboard');
        }
        else if(Auth::user()->user_type == 2)
        {
            return view('teacher.dashboard');
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.dashboard');
        }
    }
}
