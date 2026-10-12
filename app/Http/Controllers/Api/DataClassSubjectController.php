<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataClassSubjectController extends Controller
{
    public function index()
    {
        $data = ClassSubjectModel::orderBy('class_id', 'asc')->get();
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
        'subject_id' => 'required',
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

    $exists = ClassSubjectModel::where('class_id', $request->class_id)
                                ->where('subject_id', $request->subject_id)
                                ->exists();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'Data sudah ada',
        ]);
    }

    $dataclasssubject = new ClassSubjectModel();
    $dataclasssubject->class_id = $request->class_id;
    $dataclasssubject->subject_id = $request->subject_id;
    $dataclasssubject->status = $request->status;
    $dataclasssubject->created_at = $request->created_at;

    $dataclasssubject->save();

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
        $data = ClassSubjectModel::find($id);
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
    $dataclass = ClassSubjectModel::find($id);
    if (empty($dataclass)) {
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }

    $rules = [
        'class_id' => 'required',
        'subject_id' => 'required',
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

    $exists = ClassSubjectModel::where('class_id', $request->class_id)
                                ->where('subject_id', $request->subject_id)
                                ->where('id', '!=', $id)
                                ->exists();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'Data sudah ada',
        ]);
    }

    $dataclass->class_id = $request->class_id;
    $dataclass->subject_id = $request->subject_id;
    $dataclass->status = $request->status;
    $dataclass->updated_at = $request->updated_at;

    $dataclass->save();

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
        $dataclass = ClassSubjectModel::find($id);
        if(empty($dataclass)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $dataclass->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}
