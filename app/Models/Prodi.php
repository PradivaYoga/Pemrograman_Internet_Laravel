<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';
    protected $fillable = ['nama', 'id_fakultas'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi');
    }
}
