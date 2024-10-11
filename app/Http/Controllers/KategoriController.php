<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class KategoriController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $kategori = kategori::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(5);
        return view('admin.DaftarBuku.indexKategori', compact('kategori'));
    }
   public function create(){
    return view('admin.DaftarBuku.tambahKategori');
   }
   public function store(Request $request){
    $validate = $request->validate([
        'name' => 'required|max:255'
    ]); 
    try{
    kategori::create([
        'name' => $validate['name']
    ]);}
    catch (QueryException $e) {
        return redirect()->back()->with('error', 'Buku gagal ditambahkan! Silakan coba lagi. Error: ' . $e->getMessage());
    }
    return redirect()->route('kategori.index')->with('success', 'Buku berhasil ditambahkan');
}
public function edit($id)
{
    $kategori = kategori::findOrFail($id);
    return view('admin.DaftarBuku.updateKategori', compact('kategori'));
}

public function update(Request $request, $id)
{
    $kategori = kategori::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|max:255'
    ]);

    try {
        

        $kategori->update($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Buku berhasil diperbarui!');
    } catch (QueryException $e) {
        return redirect()->back()->with('error', 'Buku gagal diperbarui! Silakan coba lagi. Error: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    try {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    } catch (QueryException $e) {
        return redirect()->back()->with('error', 'Kategori gagal dihapus! Error: ' . $e->getMessage());
    }
}

}
