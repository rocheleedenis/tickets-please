<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\Api\V1\TicketResource;
use App\Models\Ticket;

class AuthorTicketsController extends Controller
{
    public function index(int $author, TicketFilter $filters)
    {
        return TicketResource::collection(
            Ticket::where('user_id', $author)->filter($filters)->paginate()
        );
    }
}
