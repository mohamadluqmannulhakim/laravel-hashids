<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Hashids\Hashids;

class HashIdCast implements CastsAttributes
{
    protected $hashids;

    public function get($model, $key, $value, $attributes)
    {
        $this->hashids = new Hashids(config('hashids.custom_hash.salt'), config('hashids.custom_hash.length'));
        return $this->hashids->encode($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        $this->hashids = new Hashids(config('hashids.custom_hash.salt'), config('hashids.custom_hash.length'));
        return isset( $this->hashids->decode($value)[0] ) ? $this->hashids->decode($value)[0] : $value;
    }
}

?>