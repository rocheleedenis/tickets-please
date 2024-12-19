<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\Traits\ShouldIncludeData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'type' => 'author',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                $this->mergeWhen($request->routeIs('v1.authors.*'), [
                    'emailVerifiedAt' => $this->email_verified_at,
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
                ]),
            ],

            'include' => $this->when(
                $this->shouldInclude('tickets'),
                [
                    'tickets' => TicketResource::collection($this->tickets),
                ]
            ),

            'links' => [
                'self' => route('v1.authors.show', ['author' => $this->id]),
            ],
        ];
    }
}
