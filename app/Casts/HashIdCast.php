<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Hashids\Hashids;

class HashIdCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        // kalau specify connection keluar error
        // dd(Hashids::connection($model)->encode(4815162342));
        // -------------------------------------------

        $hash   = new Hashids();
        dd("get ", $hash->decode(4815162342));
        return decrypt($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        // kalau specify connection keluar error
        // dd(Hashids::connection($model)->encode(4815162342));
        // -------------------------------------------

        $hash   = new Hashids();
        dd("set " . $hash->encode(4815162342));
        return [$key => $hash->encode($value)];
        return [$key => encrypt($value)];
    }
}

?>