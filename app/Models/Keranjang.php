<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = "keranjang";

    protected $fillable = [
        'paket_wedding_id', 'user_id', 'jumlah_paket'
    ];

    public function paket_wedding()
    {
        return $this->belongsTo(PaketWedding::class);
    }
}
