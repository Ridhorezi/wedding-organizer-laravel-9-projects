<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileWeb extends Model
{
    use HasFactory;

    protected $table = "web";

    protected $fillable = [
        'logo', 'name', 'description', 'address', 'email', 'facebook', 'instagram', 'youtube', 'twitter', 'whatsapp'
    ];
}
