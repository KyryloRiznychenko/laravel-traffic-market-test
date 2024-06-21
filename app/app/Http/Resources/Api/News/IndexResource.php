<?php

namespace App\Http\Resources\Api\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'url' => $this->url,
            'short_description' => $this->short_description,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
