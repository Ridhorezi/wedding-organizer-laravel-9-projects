<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWedding extends Model
{
    use HasFactory;
    
    protected $table = "paket_wedding";

    protected $fillable = [
        'nama_paket', 'harga_paket', 'deskripsi_paket', 'slug'
    ];

    public function get_first_foto()
    {
        return $this->hasMany(PaketWeddingFoto::class)->limit(1);
    }

    public function get_all_foto()
    {
        return $this->hasMany(PaketWeddingFoto::class);
    }
    
    // public function get_random_foto() {
    //     return $this->hasMany(PaketWeddingFoto::class)->limit(4);
    // }
}
