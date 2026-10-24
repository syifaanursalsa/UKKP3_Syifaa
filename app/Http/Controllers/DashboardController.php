<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Dashboard admin.
     * Menampilkan ringkasan seluruh data sistem:
     * jumlah user per role dan jumlah pengaduan.
     */
    public function admin()
    {
        $totalUser      = User::count();
        $totalCustomer  = User::where('role', 'customer')->count();
        $totalPengaduan = Pengaduan::count();

        return view('admin.dashboard', compact(
            'totalUser', 'totalCustomer', 'totalPengaduan'
        ));
    }


    /**
     * Dashboard customer.
     * Hanya menampilkan pengaduan MILIK user yang sedang login,
     * bukan milik customer lain.
     */
    public function customer()
    {
        $totalPengaduan = auth()->user()->pengaduan()->count();

        // 5 pengaduan terbaru milik user yang login
        $pengaduanTerbaru = auth()->user()->pengaduan()->latest()->take(5)->get();

        return view('customer.dashboard', compact(
            'totalPengaduan', 'pengaduanTerbaru'
        ));
    }
}