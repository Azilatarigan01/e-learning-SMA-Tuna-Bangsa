<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExamModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataExamController extends Controller
{
    
    public function index()
    {
        $data = ExamModels::orderBy('name', 'asc')->get();
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
        $dataexam = new ExamModels();

        $rules = [
            'name'=>'required',
            'note'=>'required',
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

        $dataexam->name = $request->name;
        $dataexam->note = $request->note;
        $dataexam->created_at = $request->created_at;


        $post = $dataexam->save();

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
        $data = ExamModels::find($id);
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
        $dataexam = ExamModels::find($id);
        if(empty($dataexam)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
           'name'=>'required',
            'note'=>'required',
            'updated_at'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator-> fails()){
            return response()->json([
            'status' => true,
            'message' => 'Gagal melakukan update data',
            'data' => $validator->errors()
            ]);
        }

        $dataexam->name = $request->name;
        $dataexam->note= $request->note;
        $dataexam->updated_at = $request->updated_at;



        $post = $dataexam->save();

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
        $dataexam = ExamModels::find($id);
        if(empty($dataexam)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $dataexam->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}