<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = ['nama_sekolah', 'npsn', 'bentuk_pendidikan', 'status_sekolah', 'alamat', 'desa_id', 'kecamatan_id', 'latitude', 'longitude'];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
