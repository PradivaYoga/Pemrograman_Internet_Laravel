<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::with('fakultas')->orderBy('id', 'asc')->get();
        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('prodi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'id_fakultas' => 'required|exists:fakultas,id',
        ]);

        Prodi::create($request->only('nama', 'id_fakultas'));

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'id_fakultas' => 'required|exists:fakultas,id',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->only('nama', 'id_fakultas'));

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil dihapus.');
    }
}
