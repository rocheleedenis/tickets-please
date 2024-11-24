<?php

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected Builder $builder;

    public function __construct(protected Request $request)
    {
    }

    protected function filter(array $filters)
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        $this->filter($this->request->input('filters', []));

        return $builder;
    }
}
