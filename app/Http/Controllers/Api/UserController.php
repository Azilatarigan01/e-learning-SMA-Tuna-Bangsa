<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('email', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $rules = [
        'user_type' => 'required|integer',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    $additionalRules = [];
    if ($request->user_type == 1) {
        // Admin validation rules
        $additionalRules = [
            'name' => 'required|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    } elseif ($request->user_type == 2) {
        // Teacher validation rules
        $additionalRules = [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mobile_number' => 'nullable|string|max:255|unique:users',
            'marital_status' => 'required|integer',
            'address' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    } elseif ($request->user_type == 3) {
        // Student validation rules
        $additionalRules = [
            'name' => 'required|string|max:255',
            'admission_number' => 'required|string|max:255|unique:users',
            'roll_number' => 'required|string|max:255|unique:users',
            'class_id' => 'required|integer',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'religion' => 'nullable|string|max:255',
            'mobile_number' => 'nullable|string|max:255|unique:users',
            'admission_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|integer',
        ];
    }

    $validator = Validator::make($request->all(), array_merge($rules, $additionalRules));
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memasukkan data',
            'data' => $validator->errors()
        ], 400);
    }

    $user = new User();
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->user_type = $request->user_type;

    if ($request->user_type == 1) {
        $user->name = $request->name;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $user->profile_pic = $filename;
        }
    } elseif ($request->user_type == 2) {
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->mobile_number = $request->mobile_number;
        $user->marital_status = $request->marital_status;
        $user->address = $request->address;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $user->profile_pic = $filename;
        }
    } elseif ($request->user_type == 3) {
        $user->name = $request->name;
        $user->admission_number = $request->admission_number;
        $user->roll_number = $request->roll_number;
        $user->class_id = $request->class_id;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->religion = $request->religion;
        $user->mobile_number = $request->mobile_number;
        $user->admission_date = $request->admission_date;
        $user->status = $request->status;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $user->profile_pic = $filename;
        }
    }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menambahkan data',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ];

        $additionalRules = [];
        if ($request->user_type == 1) {
            // Admin validation rules
            $additionalRules = [
                'name' => 'required|string|max:255',
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        } elseif ($request->user_type == 2) {
            // Teacher validation rules
            $additionalRules = [
                'name' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'mobile_number' => 'nullable|string|max:255|unique:users,mobile_number,' . $user->id,
                'marital_status' => 'required|integer',
                'address' => 'nullable|string|max:255',
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        } elseif ($request->user_type == 3) {
            // Student validation rules
            $additionalRules = [
                'name' => 'required|string|max:255',
                'admission_number' => 'required|string|max:255|unique:users,admission_number,' . $user->id,
                'roll_number' => 'required|string|max:255|unique:users,roll_number,' . $user->id,
                'class_id' => 'required|integer',
                'gender' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'religion' => 'nullable|string|max:255',
                'mobile_number' => 'nullable|string|max:255|unique:users,mobile_number,' . $user->id,
                'admission_date' => 'required|date',
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|integer',
            ];
        }

        $validator = Validator::make($request->all(), array_merge($rules, $additionalRules));
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ], 400);
        }

        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Assign additional fields based on user type
        if ($request->user_type == 1) {
            // Admin fields
            $user->name = $request->name;
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/profile_pics'), $filename);
                $user->profile_pic = $filename;
            }
        } elseif ($request->user_type == 2) {
            // Teacher fields
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->mobile_number = $request->mobile_number;
            $user->marital_status = $request->marital_status;
            $user->address = $request->address;
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/profile_pics'), $filename);
                $user->profile_pic = $filename;
            }
        } elseif ($request->user_type == 3) {
            // Student fields
            $user->name = $request->name;
            $user->admission_number = $request->admission_number;
            $user->roll_number = $request->roll_number;
            $user->class_id = $request->class_id;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->religion = $request->religion;
            $user->mobile_number = $request->mobile_number;
            $user->admission_date = $request->admission_date;
            $user->status = $request->status;
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/profile_pics'), $filename);
                $user->profile_pic = $filename;
            }
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ], 200);
    }
}
