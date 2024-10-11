<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PeminjamanController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $peminjaman = Peminjaman::with(['user', 'buku'])->when($search, function ($query, $search) {
            return $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('buku', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        })->paginate(5);
        return view('user.peminjaman.index', compact('peminjaman'));
    }


    public function pinjam(Request $request)
{
    // Validasi tanggal pinjam agar tidak bisa memilih tanggal yang sudah lewat
    $request->validate([
        'tanggal_pinjam' => ['required', 'date', 'after_or_equal:today'],
    ], [
        'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam harus hari ini atau setelahnya.',
    ]);

    $buku = Buku::findOrFail($request->buku_id);

    // Cek apakah buku tersedia
    if ($buku->status == 'tersedia') {
        Peminjaman::create([
            'buku_id' => $buku->id,
            'user_id' => Auth::id(),
            'tanggal_pinjam' => now(),
            'tanggal_tenggat' => $request->tanggal_pinjam,
            'status' => 'diproses',  
        ]);

       
        $buku->update(['status' => 'dipinjam']);

        return redirect()->route('pinjam.index')->with('success', 'Permintaan peminjaman berhasil diajukan!');
    }

    return redirect()->back()->with('error', 'Buku sedang dipinjam atau terjadi kesalahan!');
}

    public function kembalikan($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $tanggalSekarang = now();
        $deadline = $peminjaman->tanggal_tenggat; 
        $denda = 0; 
    
        if ($peminjaman->status == 'dipinjam') {
    
            
            $peminjaman->update([
                'tanggal_kembali' => $tanggalSekarang, 
                'status' => 'dikembalikan', 
            ]);
    
          
            $peminjaman->buku->update(['status' => 'tersedia']);
    
         
            if ($deadline) {
            
                $deadline = Carbon::parse($deadline);
                
              
                if ($tanggalSekarang->isAfter($deadline)) {
                    $keterlambatan = $deadline->diffInDays($tanggalSekarang);
    
                    // Jika ada keterlambatan, hitung denda
                    if ($keterlambatan -1 > 0) {
                        $denda = round($keterlambatan) * 10000 ; 
                    }
                }
            }
    
            // Simpan denda yang telah dihitung ke database
            $peminjaman->update(['denda' => $denda,
            'status_denda' => 'ada denda',]);
    
            return redirect()->back()->with('success', 'Buku berhasil dikembalikan! ' . ($denda > 0 ? 'Denda: Rp' . number_format($denda, 0, ',', '.') : 'Tidak ada denda.'));
        }
    
        // Jika status bukan 'pinjam', beri pesan error
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku!');
    }
    
public function bacaBuku($peminjaman_id)
{
    $peminjaman = Peminjaman::findOrFail($peminjaman_id);
    
    // Cek apakah status peminjaman adalah 'pinjam'
    if ($peminjaman->status != 'dipinjam') {
        return redirect()->back()->with('error', 'Buku tidak dapat dibaca karena sudah dikembalikan atau sedang diproses!');
    }

    // Arahkan ke view yang menampilkan PDF reader
    return view('user.peminjaman.baca', ['peminjaman' => $peminjaman]);
}
public function buktiBayar($peminjaman_id, Request $request) {
    // Validasi file bukti_denda
    $request->validate([
        'bukti_denda' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
    ]);

    // Cari peminjaman berdasarkan ID
    $peminjaman = Peminjaman::findOrFail($peminjaman_id);

    // Cek status denda
    if ($peminjaman->status_denda == "ada denda") {
        try {
            // Simpan file yang diupload
            $file = $request->file('bukti_denda');
            $filePath = $file->store('bukti_denda', 'public');

            // Update bukti denda di peminjaman yang ada
            $peminjaman->update(['bukti_denda' => $filePath]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Bukti denda berhasil diupload!');
        } catch (Exception $e) {
            // Tangani kesalahan dan kirim pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload bukti denda!');
        }
    } else {
        // Jika tidak ada denda, kirim pesan error
        return redirect()->back()->with('error', 'Tidak ada denda yang harus dibayar.');
    }
}


}
