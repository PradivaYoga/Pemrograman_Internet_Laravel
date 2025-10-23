<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'nim',
        'nama',
        'id_prodi'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
