<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'booking_date'  => $this->booking_date,
            'status'        => $this->status,
            'service'       => new ServiceResource($this->whenLoaded('service')),
            'user'          => $this->whenLoaded('user'), 
        ];
    }
}