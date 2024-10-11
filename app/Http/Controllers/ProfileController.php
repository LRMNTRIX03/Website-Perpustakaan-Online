<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        return view('user.profile.index');
    }
    public function editPassword($id){
        $user = User::findorFail($id);
        return view('user.profile.gantiPassword', compact('user'));
    }
    public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'TTL' => 'required|date',
        'JenisKelamin' => 'required',
        'noTelp' => 'required|string|max:15',
        'alamat' => 'required|string|max:255',
        'fotoUrl' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi untuk file gambar
    ]);

    // Temukan user berdasarkan ID
    $user = User::findOrFail($id);

    // Update data user
    $user->name = $request->input('name');
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->TTL = $request->input('TTL');
    $user->JenisKelamin = $request->input('JenisKelamin');
    $user->noTelp = $request->input('noTelp');
    $user->alamat = $request->input('alamat');

    // Cek apakah ada file yang di-upload
    if ($request->hasFile('fotoUrl')) {
        $file = $request->file('fotoUrl');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads', $filename);

        // Update URL foto
        $user->fotoUrl = 'uploads/' . $filename;
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'Data berhasil diupdate');
}

    public function changePassword(Request $request){
        $passwordLama = $request->password_lama;
        $passwordBaru = $request->password_baru;

        if(!Hash::check($passwordLama, Auth::user()->password)){
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }else{
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($passwordBaru);
            $user->save();
            return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}
}
