<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'kamar_id';

    protected $fillable = [
        'kamar_kategori_id',
        'kamar_nama',
        'kamar_img',
        'kamar_harga',
        'kamar_rating',
        'kamar_lantai',
        'kamar_no',
        'kamar_kapasitas'
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kamar_kategori_id');
    }

    public function sewaDetail()
{
    return $this->hasOne(SewaDetail::class, 'sewa_detail_kamar_id', 'kamar_id');
}

}
