<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
    public function toArray(Request $request): array
    {
        $data = $this->data;
        return [
            'id' => $this->id,
            'notifiable_id' => $this->notifiable_id,
            'notifiable_name' => optional($this->notifiable)->name,
            'message' => $data['message'],
        ];
    }
}
