<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatasetRiwayat extends Model
{
    protected $casts = [
        'verified_at' => 'datetime',
    ];
    
    protected $fillable = [
        'dataset_id',
        'user_id',
        'versi',
        'nama_opd',
        'status',
        'catatan',
        'verified_by',
        'verified_at'
    ];

    public function dataset()
    {
        return $this->belongsTo(Dataset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
