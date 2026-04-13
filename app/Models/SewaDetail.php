<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaDetail extends Model
{
    use HasFactory;

    protected $table = 'sewa_detail';
    protected $primaryKey = 'sewa_detail_id';

    protected $fillable = [
        'sewa_detail_sewa_id',
        'sewa_detail_kamar_id',
        'sewa_detail_status',
        'sewa_detail_total',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'sewa_detail_sewa_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'sewa_detail_kamar_id');
    }
}
