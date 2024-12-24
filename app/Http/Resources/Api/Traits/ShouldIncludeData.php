<?php

namespace App\Http\Resources\Api\Traits;

use Illuminate\Support\Str;

trait ShouldIncludeData
{
    public static function shouldInclude(string $relationship): bool
    {
        $param = request()->get('include');

        if (! $param) {
            return false;
        }

        $includeValues = explode(',', Str::lower($param));

        return in_array(Str::lower($relationship), $includeValues);
    }
}
