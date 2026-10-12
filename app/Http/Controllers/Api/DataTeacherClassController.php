<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignClassTeacherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DataTeacherClassController extends Controller
{
    public function index()
    {
        $data = AssignClassTeacherModel::orderBy('id', 'asc')->get();
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
        'class_id' => 'required',
        'teacher_id' => 'required',
        'status' => 'required',
        'created_at' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memasukkan data',
            'data' => $validator->errors()
        ]);
    }

    $exists = AssignClassTeacherModel::where('class_id', $request->class_id)
                                ->where('teacher_id', $request->teacher_id)
                                ->exists();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'Data sudah ada',
        ]);
    }

    $datateacherclass = new AssignClassTeacherModel();
    $datateacherclass->class_id = $request->class_id;
    $datateacherclass->teacher_id = $request->teacher_id;
    $datateacherclass->status = $request->status;
    $datateacherclass->created_at = $request->created_at;

    $datateacherclass->save();

    return response()->json([
        'status' => true,
        'message' => 'Sukses menambahkan data',
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = AssignClassTeacherModel::find($id);
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
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $datateacherclass = AssignClassTeacherModel::find($id);
    if (empty($datateacherclass)) {
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }

    $rules = [
        'class_id' => 'required',
        'teacher_id' => 'required',
        'status' => 'required',
        'updated_at' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal melakukan update data',
            'data' => $validator->errors()
        ]);
    }

    $exists = AssignClassTeacherModel::where('class_id', $request->class_id)
                                ->where('teacher_id', $request->teacher_id)
                                ->where('id', '!=', $id)
                                ->exists();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'Data sudah ada',
        ]);
    }

    $datateacherclass->class_id = $request->class_id;
    $datateacherclass->teacher_id = $request->teacher_id;
    $datateacherclass->status = $request->status;
    $datateacherclass->updated_at = $request->updated_at;

    $datateacherclass->save();

    return response()->json([
        'status' => true,
        'message' => 'Sukses melakukan update data',
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datateacherclass = AssignClassTeacherModel::find($id);
        if(empty($datateacherclass)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $datateacherclass->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}
