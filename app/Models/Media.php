<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table      = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_path',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'ref_id', 'kejadian_id')
            ->where('ref_table', 'kejadian_bencana');
    }

}
