<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogistikBencana extends Model
{
    use HasFactory;

    protected $table      = 'logistik_bencana';
    protected $primaryKey = 'logistik_id';
    protected $fillable   = [
        'kejadian_id',
        'nama_barang',
        'satuan',
        'stok',
        'sumber',
        'keterangan',
    ];

    // Relasi ke kejadian bencana
    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'logistik_id')
            ->where('ref_table', 'logistik_bencana');
    }
}
