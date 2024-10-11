<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPeminjamanController extends Controller
{
    // Tampilkan daftar peminjaman yang harus disetujui atau ditolak
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $peminjaman = Peminjaman::with(['user', 'buku']) // Eager load untuk relasi
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('buku', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                });
            })
            ->paginate(5);
    
        return view('admin.peminjaman.index', compact('peminjaman'));
    }
    

    // Fungsi untuk menyetujui peminjaman
    public function approve($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        // Update status menjadi 'borrowed'
        $peminjaman->update(['status' => 'dipinjam']);

        return redirect()->back()->with('success', 'Peminjaman telah disetujui!');
    }

    // Fungsi untuk menolak peminjaman
    public function reject($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        $peminjaman->update(['status' => 'ditolak']);

        // Update status buku menjadi 'available' kembali
        $peminjaman->buku->update(['status' => 'tersedia']);

        return redirect()->back()->with('error', 'Peminjaman telah ditolak!');
    }
    public function confirmBayar($peminjaman_id){

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $peminjaman->update(['status_denda' => 'Sudah lunas']);
        return redirect()->back()->with('success', 'Denda telah dikonfirmasi!');
    }
    public function rejectBukti($peminjaman_id)
{
    // Cari peminjaman berdasarkan ID
    $peminjaman = Peminjaman::findOrFail($peminjaman_id);
    
    // Dapatkan path file dari database
    $filePath = $peminjaman->bukti_denda;

    // Cek apakah file ada di storage, lalu hapus
    if ($filePath && Storage::disk('public')->exists($filePath)) {
        Storage::disk('public')->delete($filePath);
    }

    // Update kolom bukti_denda di database menjadi null
    $peminjaman->update(['bukti_denda' => null]);

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Denda telah dibatalkan dan bukti pembayaran berhasil dihapus!');
}
    public function destory($peminjaman_id){

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $peminjaman->delete();
        return redirect()->back()->with('success', 'Peminjaman telah dihapus!');
    }
    

}
