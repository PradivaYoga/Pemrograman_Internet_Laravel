<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Tampilkan mahasiswa beserta relasi prodi dan fakultas
        $mahasiswas = Mahasiswa::with('prodi.fakultas')->orderBy('id', 'asc')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        // Kirim daftar prodi untuk dropdown
        $prodis = Prodi::with('fakultas')->orderBy('nama')->get();
        return view('mahasiswa.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'id_prodi' => 'required|exists:prodis,id',
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodis = Prodi::with('fakultas')->orderBy('nama')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:100',
            'id_prodi' => 'required|exists:prodis,id',
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
