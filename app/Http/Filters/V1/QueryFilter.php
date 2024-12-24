<?php

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    protected Builder $builder;

    protected array $sortables = [];

    public function __construct(protected Request $request) {}

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        $this->filter($this->request->input('filters', []));
        $this->sort($this->request->input('sort', ''));

        return $builder;
    }

    protected function filter(array $filters): Builder
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    protected function sort($value)
    {
        $attributes = explode(',', $value);

        foreach ($attributes as $attribute) {
            $direction = Str::startsWith($attribute, '-') ? 'desc' : 'asc';
            $column = Str::of($attribute)->remove('-')->snake()->value();

            if (in_array($column, $this->sortables)) {
                $this->builder->orderBy($column, $direction);
            }
        }
    }
}
