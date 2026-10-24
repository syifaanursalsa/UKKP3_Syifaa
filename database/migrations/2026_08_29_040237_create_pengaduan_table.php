<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pengaduan.
     */
      
    public function store(Request $request)
{
    $request->validate([
        'kategori'  => 'required|string', // Ubah dari kategori_id menjadi string biasa
        'pengaduan' => 'required|string',
        'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $foto = null;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('pengaduan', 'public');
    }

    auth()->user()->pengaduan()->create([
        'kategori'  => $request->kategori, // Simpan sebagai teks biasa
        'pengaduan' => $request->pengaduan,
        'foto'      => $foto,
        'status'    => 'menunggu',
    ]);

    return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
}  

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};