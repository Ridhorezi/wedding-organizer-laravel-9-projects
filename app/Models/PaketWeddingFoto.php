<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWeddingFoto extends Model
{
    use HasFactory;

    protected $table = "paket_wedding_foto";

    protected $fillable = [
        'paket_wedding_id', 'name', 'size', 'url'
    ];

    public function paket_wedding()
    {
        return $this->belongsTo(PaketWedding::class);
    }
}
