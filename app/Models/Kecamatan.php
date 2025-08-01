<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kecataman'];

    public function desas()
    {
        return $this->hasMany(Desa::class);
    }

    public function sekolahs()
    {
        return $this->hasMany(Sekolah::class);
    }
}
