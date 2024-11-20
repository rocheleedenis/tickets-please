<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\Traits\ShouldIncludeData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    use ShouldIncludeData;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ticket',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->when(
                    $request->routeIs('v1.tickets.show'),
                    $this->description
                ),
                'status' => $this->status,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],

            'relationships' => [
                'author' => [
                    'type' => 'user',
                    'id' => $this->user_id,
                    'links' => [
                        'self' => route('v1.users.show', ['user' => $this->user_id]),
                    ],
                ],
            ],

            'includes' => $this->when(
                $this->shouldInclude('author'),
                [
                    'author' => new UserResource($this->user),
                ]
            ),

            'links' => [
                'self' => route('v1.tickets.show', ['ticket' => $this->id]),
            ],
        ];
    }
}
