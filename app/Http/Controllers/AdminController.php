<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {
        $getRecords = User::where('user_type', 1)->orderBy('id', 'desc')->paginate(10);
        return view('admin.admin.list', compact('getRecords'));
    }

    public function add()
    {
        return view('admin.admin.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $admin = new User;
    
        $admin->email = trim($request->email);
        $admin->password = Hash::make($request->password);
        $admin->user_type = 3;
        $admin->save();
    
        return redirect()->route('admin.admin.list')->with('success', 'admin added successfully.');
    }

    public function showEditForm($id)
{
    $user = User::findOrFail($id);
    return view('admin.admin.edit', compact('user'));
}

public function update($id, Request $request)
{
    $user = User::findOrFail($id);

    $user->name = trim($request->name);
    $user->email = trim($request->email);

    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('profil')) {
        $file = $request->file('profil');

        if ($file->isValid() && in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            // Hapus file lama jika ada
            if (!empty($user->profil) && file_exists(public_path('uploads/profiles/' . $user->profil))) {
                unlink(public_path('uploads/profiles/' . $user->profil));
            }

            // Simpan file baru
            $fileName = time() . '_' . preg_replace('/\s+/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                        . '.' . $file->getClientOriginalExtension();

            if (strlen($fileName) > 255) {
                return redirect()->back()->with('error', 'Nama file terlalu panjang.');
            }

            $file->move(public_path('uploads/profiles'), $fileName);

            // Simpan nama file ke database
            $user->profil = $fileName;
        }
    }

    $user->save();

    return redirect()->route('admin.list')->with('success', 'Admin updated successfully.');
}


    
    public function delete($id)
{
    $user = User::find($id);
    if (!$user) {
        abort(404);
    }

    $user->delete();

    return redirect('admin/admin/list')->with('success', "Admin berhasil dihapus");
}

}
