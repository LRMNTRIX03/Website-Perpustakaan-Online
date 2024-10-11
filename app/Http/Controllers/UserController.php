<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
public function DaftarBuku(Request $request)
{
    
    $search = $request->input('search');
    $category_id = $request->input('category_id');

    // Query to search by title or author
    $buku = Buku::where(function($query) use ($search) {
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
    });

   
    if ($category_id) {
        $buku->where('category_id', $category_id);
    }

    // Paginate the results
    $buku = $buku->paginate(8);

    // Get all categories for the filter dropdown
    $categories = kategori::all();

    return view('user.daftarBuku.index', compact('buku', 'search', 'categories', 'category_id'));
}

    public function Detail($id){
        $peminjaman = Peminjaman::paginate(10);
        $buku = Buku::findOrFail($id);
        return view('user.daftarBuku.detailBuku', compact('buku', 'peminjaman'));
    }
   
}
