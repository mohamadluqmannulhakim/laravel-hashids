<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Hashids\Hashids;

class HashIdCast implements CastsAttributes
{
    protected $hashids;

    public function get($model, $key, $value, $attributes)
    {
        $this->hashids = new Hashids($model->table, 5);
        return $this->hashids->encode($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        $this->hashids = new Hashids($model->table, 5);
        return $this->hashids->decode($value);
    }
}

?>