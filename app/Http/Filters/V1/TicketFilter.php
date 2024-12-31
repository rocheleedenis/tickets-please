<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;

class TicketFilter extends QueryFilter
{
    protected array $sortables = [
        'title',
        'status',
        'created_at',
    ];

    public function status(string $value): Builder
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function title(string $value): Builder
    {
        return $this->builder->where('title', 'like', "%$value%");
    }

    public function createAt(string $value): Builder
    {
        $dates = explode(',', $value);

        return count($dates) === 1
            ? $this->builder->whereDate('created_at', $value)
            : $this->builder->whereBetween('created_at', $dates);
    }
}
