<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;

class AuthorFilter extends QueryFilter
{
    public function name(string $value): Builder
    {
        return $this->builder->where('name', 'like', "%$value%");
    }

    public function email(string $value): Builder
    {
        return $this->builder->where('email', 'like', "%$value%");
    }

    public function createAt(string $value): Builder
    {
        $dates = explode(',', $value);

        return count($dates) === 1
            ? $this->builder->whereDate('created_at', $value)
            : $this->builder->whereBetween('created_at', $dates);
    }
}

