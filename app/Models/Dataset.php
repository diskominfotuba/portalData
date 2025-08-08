<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $fillable = ['nama_data', 'slug', 'nama_opd', 'deskripsi', 'model_class', 'status'];

    public function histories()
    {
        return $this->hasMany(DatasetRiwayat::class, 'dataset_id');
    }

    public function latestVerifiedVersion()
    {
        return $this->hasOne(DatasetRiwayat::class, 'dataset_id')
            ->where('status', 'publish')
            ->latestOfMany('verified_at');
    }
}
