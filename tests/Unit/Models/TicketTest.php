<?php

namespace Tests\Unit\Models;

use App\Http\Filters\V1\QueryFilter;
use App\Models\Ticket;
use App\Models\User;

it('checks author relationship', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create(['user_id' => $user->id]);

    expect($ticket->author)->toBeInstanceOf(User::class);
    expect($ticket->author->id)->toBe($user->id);
});

it('checks scope filter', function () {
    $queryFilterMock = $this->createMock(QueryFilter::class);
    $queryFilterMock->expects($this->once())
        ->method('apply')
        ->willReturnCallback(function ($builder) {
            return $builder;
        });

    $builder = Ticket::query();
    $result = (new Ticket)->scopeFilter($builder, $queryFilterMock);

    expect($result)->toBe($builder);
});
