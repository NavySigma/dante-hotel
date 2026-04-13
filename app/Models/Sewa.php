<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Sewa extends Model
{
    use HasFactory;

    protected $table = 'sewa';
    protected $primaryKey = 'sewa_id';

    protected $fillable = [
        'sewa_user_id',
        'sewa_tglcheckin',
        'sewa_tglcheckout',
        'sewa_status',   // tersedia / disewa
        'sewa_note',
        'sewa_denda',
        'sewa_metode',
        'sewa_lamamenginap',
    ];

    public function getDurasiAttribute()
{
    return Carbon::parse($this->check_in)->diffInDays(Carbon::parse($this->check_out));
}


    public function user()
    {
        return $this->belongsTo(User::class, 'sewa_user_id');
    }

    public function detail()
    {
        return $this->hasMany(SewaDetail::class, 'sewa_detail_sewa_id');
    }

    public function kamar()
{
    return $this->hasOneThrough(
        Kamar::class,
        SewaDetail::class,
        'sewa_detail_sewa_id',
        'kamar_id',
        'sewa_id',
        'sewa_detail_kamar_id'
    );
}

}
