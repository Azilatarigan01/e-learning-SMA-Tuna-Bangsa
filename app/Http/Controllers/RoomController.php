<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomModel;

class RoomController extends Controller
{
    public function list()
    {
        $data['getRecord'] = RoomModel::getRecord();
        $data['header_title'] = "Master Data Ruangan";
        return view('admin.room.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Tambah Ruangan Baru";
        return view('admin.room.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'capacity' => 'required|numeric|min:1',
        ]);

        $save = new RoomModel;
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->capacity = trim($request->capacity);
        $save->status = trim($request->status ?? 0);
        $save->notes = trim($request->notes);
        $save->save();

        return redirect('admin/room/list')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['getRecord'] = RoomModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Data Ruangan";
            return view('admin.room.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'capacity' => 'required|numeric|min:1',
        ]);

        $save = RoomModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->capacity = trim($request->capacity);
        $save->status = trim($request->status);
        $save->notes = trim($request->notes);
        $save->save();

        return redirect('admin/room/list')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $record = RoomModel::getSingle($id);
        if (!empty($record)) {
            $record->delete();
            return redirect('admin/room/list')->with('success', 'Ruangan berhasil dihapus.');
        }
        return redirect('admin/room/list')->with('error', 'Data tidak ditemukan.');
    }
}
