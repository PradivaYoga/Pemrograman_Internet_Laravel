<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::orderBy('id', 'asc')->get();
        return view('fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        Fakultas::create($request->only('nama'));

        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->update($request->only('nama'));

        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil dihapus.');
    }
}
