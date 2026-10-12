<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataSubjectController extends Controller
{
    public function index()
    {
        $data = SubjectModel::orderBy('name', 'asc')->get();
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
        $datasubject = new SubjectModel();

        $rules = [
            'name'=>'required',
            'type'=>'required',
            'status'=>'required',
            'is_delete'=>'required',
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

        $datasubject->name = $request->name;
        $datasubject->type = $request->type;
        $datasubject->status = $request->status;
        $datasubject->is_delete = $request->is_delete;
        $datasubject->created_at = $request->created_at;


        $post = $datasubject->save();

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
        $data = SubjectModel::find($id);
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
        $datasubject = SubjectModel::find($id);
        if(empty($datasubject)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'name'=>'required',
            'type'=>'required',
            'status'=>'required',
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
        $datasubject->name = $request->name;
        $datasubject->type = $request->type;
        $datasubject->status = $request->status;
        $datasubject->updated_at = $request->updated_at;



        $post = $datasubject->save();

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
        $datasubject = SubjectModel::find($id);
        if(empty($datasubject)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $datasubject->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}