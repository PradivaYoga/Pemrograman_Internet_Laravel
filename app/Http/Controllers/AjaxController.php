<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

class AjaxController extends Controller
{
    public function getProdi($fakultas_id)
    {
        $prodis = Prodi::where('id_fakultas', $fakultas_id)
            ->orderBy('nama')
            ->get();

        return response()->json($prodis);
    }
}
