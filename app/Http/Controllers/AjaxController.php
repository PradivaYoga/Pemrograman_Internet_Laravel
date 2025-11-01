<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;

class AjaxController extends Controller
{
    /**
     * Mengambil daftar program studi berdasarkan fakultas.
     *
     * @param  int  $fakultas_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProdi($fakultas_id)
    {
        if (!is_numeric($fakultas_id) || $fakultas_id <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID fakultas tidak valid.'
            ], 400);
        }

        $prodis = Prodi::where('id_fakultas', $fakultas_id)
            ->orderBy('nama')
            ->get(['id', 'nama']);

        if ($prodis->isEmpty()) {
            return response()->json([
                'status' => 'empty',
                'message' => 'Tidak ada program studi untuk fakultas ini.',
                'data' => []
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data program studi ditemukan.',
            'data' => $prodis
        ], 200);
    }
}
