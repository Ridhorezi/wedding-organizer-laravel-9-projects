<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = "pemesanan";

    protected $fillable = [
        'paket_wedding_id', 'user_id', 'jumlah_paket', 'tempat_acara', 'tanggal_acara', 'status_pembayaran'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paket_wedding()
    {
        return $this->belongsTo(PaketWedding::class);
    }
}
