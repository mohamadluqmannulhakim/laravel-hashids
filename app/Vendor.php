<?php

namespace App;

use App\Casts\HashIdCast;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'users_id'
    ];

    protected $casts = [
        'id'        => HashIdCast::class,
        'users_id'  => HashIdCast::class
    ];

    /* Model Relationship */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
