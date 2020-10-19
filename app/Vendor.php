<?php

namespace App;

use App\Casts\HashIdCast;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name', 'email'
    ];

    protected $casts = [
        'id' => HashIdCast::class
    ];
}
