<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // ==========================================
    // KHUSUS CUSTOMER
    // ==========================================

    // 1. TAMPILKAN FORM BUAT PENGADUAN
    public function create()
    {
        // Langsung return view, tidak perlu query database kategori lagi
        return view('pengaduan.create');
    }

    // 2. SIMPAN PENGADUAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'kategori'  => 'required|string',
            'pengaduan' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pengaduan', 'public');
        }

        auth()->user()->pengaduan()->create([
            'kategori'  => $request->kategori,
            'pengaduan' => $request->pengaduan,
            'foto'      => $foto,
            'status'    => 'menunggu',
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    // 3. LIHAT DAFTAR PENGADUAN MILIK SENDIRI
    public function index()
    {
        $pengaduan = auth()->user()->pengaduan()->latest()->get();
        
        // Pastikan nama file view kamu adalah 'pengaduan.index' atau 'pengaduan.saya'
        return view('pengaduan.index', compact('pengaduan')); 
    }

    // ==========================================
    // KHUSUS ADMIN (KELOLA)
    // ==========================================

    // 4. LIHAT SEMUA PENGADUAN
    public function kelola()
    {
        $pengaduan = Pengaduan::latest()->get();
       return view('pengaduan.kelola', compact('pengaduan'));
    }

    // 5. UBAH STATUS
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    // 6. HAPUS PENGADUAN
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }
        
        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}