<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiBencana extends Model
{
    protected $table = 'donasi_bencana';
    protected $primaryKey = 'donasi_id';

    protected $fillable = [
        'kejadian_id',
        'donatur_nama',
        'jenis',
        'nilai',
        'bukti'
    ];

    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }

    public function posko()
    {
        return $this->belongsTo(PoskoBencana::class, 'posko_id', 'posko_id');
    }
}
