<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoskoBencana extends Model
{
    protected $table = 'posko_bencana';

    // Primary key
    protected $primaryKey = 'posko_id';

    // Kolom yang bisa diisi lewat form
    protected $fillable = [
        'kejadian_id',
        'nama',
        'alamat',
        'kontak',
        'penanggung_jawab',
        'foto'
    ];
    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'id_kejadian', 'id_kejadian');
    }
}
