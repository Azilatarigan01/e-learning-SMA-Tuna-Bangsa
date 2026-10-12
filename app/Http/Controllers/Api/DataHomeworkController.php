<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeworkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataHomeworkController extends Controller
{
    public function index()
    {
        $data = HomeworkModel::orderBy('class_id', 'asc')->get();
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
        $datahomework = new HomeworkModel();

        $rules = [
            'class_id'=>'required',
            'subject_id'=>'required',
            'homework_date'=>'required',
            'submission_date'=>'required',
            'document_file'=>'required|file|max:10240',
            'description'=>'required',
            'created_at'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator-> fails()){
            return response()->json([
            'status' => true,
            'message' => 'Gagal memasukkan data',
            'data' => $validator->errors()
            ]);
        }

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/homework'), $fileName);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'File tidak ditemukan dalam request',
            ], 400);
        }

        $datahomework->class_id = $request->class_id;
        $datahomework->subject_id = $request->subject_id;
        $datahomework->homework_date = $request->homework_date;
        $datahomework->submission_date = $request->submission_date;
        $datahomework->document_file = $fileName;
        $datahomework->description = $request->description;
        $datahomework->created_at = $request->created_at;

        $post = $datahomework->save();

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
        $data = HomeworkModel::find($id);
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
    $datahomework = HomeworkModel::find($id);
    if (empty($datahomework)) {
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }

    $rules = [
        'class_id' => 'required',
        'subject_id' => 'required',
        'homework_date' => 'required',
        'submission_date' => 'required',
        'document_file' => 'file|max:10240', // Menghapus 'required' agar file menjadi opsional
        'description' => 'required',
        'updated_at' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => true,
            'message' => 'Gagal melakukan update data',
            'data' => $validator->errors()
        ]);
    }

    if ($request->hasFile('document_file')) {
        $file = $request->file('document_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/homework'), $fileName);
        $datahomework->document_file = $fileName;
    }

    $datahomework->class_id = $request->class_id;
    $datahomework->subject_id = $request->subject_id;
    $datahomework->homework_date = $request->homework_date;
    $datahomework->submission_date = $request->submission_date;
    $datahomework->description = $request->description;
    $datahomework->updated_at = $request->updated_at;

    $post = $datahomework->save();

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
        $datahomework = HomeworkModel::find($id); // Corrected variable name
        if(empty($datahomework)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $datahomework->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}