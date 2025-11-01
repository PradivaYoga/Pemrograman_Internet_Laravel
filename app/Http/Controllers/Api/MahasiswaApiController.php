<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaApiController extends Controller
{
    public function index()
    {
        return Mahasiswa::with('prodi.fakultas')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'id_prodi' => 'required|exists:prodis,id'
        ]);

        $m = Mahasiswa::create($data);
        return response()->json($m, 201);
    }

    public function show($id)
    {
        return Mahasiswa::with('prodi.fakultas')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $data = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|string|max:100',
            'id_prodi' => 'required|exists:prodis,id'
        ]);

        $mahasiswa->update($data);
        return response()->json($mahasiswa);
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
