<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'kategori_nama',
        'kategori_deskripsi',
    ];

    public function kamarS()
    {
        return $this->hasMany(Kamar::class, 'kamar_kategori_id');
    }
}
