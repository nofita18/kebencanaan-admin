<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiLogistik extends Model
{
    use HasFactory;

    protected $table = 'distribusi_logistik';
    protected $primaryKey = 'distribusi_id';
    protected $fillable = [
        'logistik_id',
        'posko_id',
        'tanggal',
        'jumlah',
        'penerima',
        'keterangan',
    ];

    // Relasi ke logistik
    public function logistik()
    {
        return $this->belongsTo(LogistikBencana::class, 'logistik_id', 'logistik_id');
    }

    // Relasi ke posko
    public function posko()
    {
        return $this->belongsTo(PoskoBencana::class, 'posko_id', 'posko_id');
    }

    // Relasi ke media (bukti distribusi)
    public function media()
    {
        return $this->hasOne(Media::class, 'ref_id', 'distribusi_id')
                    ->where('ref_table', 'distribusi_logistik');
    }
}
