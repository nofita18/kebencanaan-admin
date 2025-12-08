<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    protected $table      = 'kejadian_bencana';
    protected $primaryKey = 'kejadian_id';

    protected $fillable = [
        'jenis_bencana',
        'tanggal',
        'lokasi',
        'rt',
        'rw',
        'dampak',
        'status_kejadian',
        'keterangan',
        'deskripsi_singkat',
        'foto',
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'kejadian_id')
            ->where('ref_table', 'kejadian_bencana');
    }

}
