<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DaftarBukuController extends Controller
{
    public function index(Request $request)
    {
       $search = $request->input('search');
        $buku = Buku::when($search, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('author', 'like', '%' . $search . '%')
                         ->orWhere('isbn', 'like', '%' . $search . '%');
        })->paginate(5);
        return view('admin.DaftarBuku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::paginate(5);
        return view('admin.DaftarBuku.create', compact('kategori'));
    }

    public function store(Request $request)
    { 
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'nullable|max:255',
            'year_published' => 'nullable|digits:4',
            'isbn' => 'required|max:13',
            'category_id' => 'required',
            'deskripsi'=>'nullable|max:255',
            'formFile' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'formPDF' => 'nullable|file|mimes:pdf|max:50000', 
        ]);
        
       

        try {
            if ($request->hasFile('formFile')) {
                $file = $request->file('formFile');
                $filePath = $file->store('cover_buku', 'public');
                $validatedData['formFile'] = $filePath;
            }

            if ($request->hasFile('formPDF')) {
                $file1 = $request->file('formPDF');
                $filePath1 = $file1->store('pdf_buku', 'public');
                $validatedData['formPDF'] = $filePath1;
            }

            Buku::create([
                'title' => $validatedData['title'],
                'author' => $validatedData['author'] ,
                'publisher' => $validatedData['publisher'] ?? null,
                'year_published' => $validatedData['year_published'] ?? null,
                'isbn' => $validatedData['isbn'],
                'category_id' => $validatedData['category_id'],
                'deskripsi' => $validatedData['deskripsi'] ?? null,
                'urlFoto' => $validatedData['formFile'] ?? null,
                'urlPDF' => $validatedData['formPDF'] ?? null,
                'status' => 'tersedia',
            ]);

            return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Buku gagal ditambahkan! Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.DaftarBuku.update', compact('buku','kategori'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year_published' => 'required|digits:4', 
            'isbn' => 'required|max:13',
            'category_id' => 'required',
            'deskripsi'=>'nullable|max:255',
            'formFile' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', 
            'formPDF' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            if ($request->hasFile('formFile')) {
                $file = $request->file('formFile');
                $filePath = $file->store('cover_buku', 'public');
                $validatedData['urlFoto'] = $filePath;
            }

            if ($request->hasFile('formPDF')) {
                $file1 = $request->file('formPDF');
                $filePath1 = $file1->store('pdf_buku', 'public');
                $validatedData['urlPDF'] = $filePath1;
            }

            $buku->update($validatedData);

            return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Buku gagal diperbarui! Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();

            return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Buku gagal dihapus! Error: ' . $e->getMessage());
        }
    }
}
