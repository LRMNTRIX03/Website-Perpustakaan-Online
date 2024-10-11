<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardAdmin(){
        $jmlUser = User::where('role', 'user')->count();
        $jmlBuku = Buku::count();
        $jmlPinjaman = Peminjaman::count();
        $jmlantrianPinjaman = Peminjaman::where('status', 'proses')->count();
        return view('admin.dashboard', compact('jmlUser', 'jmlBuku', 'jmlPinjaman', 'jmlantrianPinjaman'));
    }
    public function dashboardUser() {
        $buku = Buku::limit(5)->get();
        return view('user.dashboard', compact('buku'));        
    }
}
