<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DaftarAnggotaController extends Controller
{
    public function index(){
        $search = request()->input('search');
        $user = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('username', 'like', '%' . $search . '%');
        })->where('role', 'user')->paginate(5);
        return view('admin.DaftarUser.index', compact('user'));
    }
    public function create()
    {
        return view('admin.DaftarUser.create');
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:10|unique:users',
            'email' => 'required|email|unique:users',
            'TTL' => 'required|date',
            'JenisKelamin' => 'required|string',
            'noTelp' => 'required|string',
            'alamat' => 'required|string',
            'fotoUrl' => 'image|nullable|max:2048',
        ]);
        try {
            
            if ($request->hasFile('fotoUrl')) {
                $file = $request->file('fotoUrl');
                $filePath = $file->store('anggota', 'public');
                $validatedData['fotoUrl'] = $filePath;
            } else {
            $filePath = null;
        }
        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'TTL' => $validated['TTL'],
            'JenisKelamin' => $validated['JenisKelamin'],
            'noTelp' => $validated['noTelp'],
            'alamat' => $validated['alamat'],
            'fotoUrl' => $filePath,
            'role' => 'user', 
            'password'=> Hash::make('P'. $validated['username'])
        ]);
        return redirect()->route('anggota.index')->with('success', 'Buku berhasil ditambahkan!');
        }      
     catch (QueryException $e) {
        return redirect()->back()->with('error', 'Anggota gagal ditambahkan! Silakan coba lagi. Error: ' . $e->getMessage());
    } 
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.DaftarUser.update', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        'email' => 'required|email|unique:users,email,'.$user->id,
        'TTL' => 'required|date',
        'JenisKelamin' => 'required|string',
        'noTelp' => 'required|string',
        'alamat' => 'required|string',
        'fotoUrl' => 'mimes:jpg,png,jpeg|nullable|max:2048',
    ]);

    try {
        if ($request->hasFile('fotoUrl')) {
            
            if ($user->fotoUrl && Storage::disk('public')->exists($user->fotoUrl)) {
                Storage::disk('public')->delete($user->fotoUrl);
            }

            $file = $request->file('fotoUrl');
            $filePath = $file->store('anggota', 'public');
            $validatedData['fotoUrl'] = $filePath;
        }

        $user->update($validatedData);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui!');
    } catch (QueryException $e) {
        return redirect()->back()->with('error', 'Anggota gagal diperbarui! Silakan coba lagi. Error: ' . $e->getMessage());
    }
}


    public function destroy($id)
{
    try {
        $user = User::findOrFail($id);

      
        if ($user->fotoUrl && Storage::disk('public')->exists($user->fotoUrl)) {
            Storage::disk('public')->delete($user->fotoUrl);
        }

        $user->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    } catch (QueryException $e) {
        return redirect()->back()->with('error', 'Anggota gagal dihapus! Error: ' . $e->getMessage());
    }
}
public function print($id)
{
    $user = User::findOrFail($id);
    return view('admin.DaftarUser.print', compact('user'));
}

}

