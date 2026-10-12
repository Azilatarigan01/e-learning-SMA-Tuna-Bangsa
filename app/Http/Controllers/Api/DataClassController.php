<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataClassController extends Controller
{
    public function index()
    {
        $data = ClassModel::orderBy('name', 'asc')->get();
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
        $dataclass = new ClassModel();

        $rules = [
            'name'=>'required',
            'status'=>'required',
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

        $dataclass->name = $request->name;
        $dataclass->status = $request->status;
        $dataclass->created_at = $request->created_at;


        $post = $dataclass->save();

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
        $data = ClassModel::find($id);
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
        $dataclass = ClassModel::find($id);
        if(empty($dataclass)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
           'name'=>'required',
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
        $dataclass->name = $request->name;
        $dataclass->status = $request->status;
        $dataclass->updated_at = $request->update_at;



        $post = $dataclass->save();

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
        $dataclass = ClassModel::find($id);
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