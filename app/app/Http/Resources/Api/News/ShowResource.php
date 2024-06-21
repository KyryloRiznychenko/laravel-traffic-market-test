<?php

namespace App\Http\Resources\Api\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $dataKeys = array_keys($data);
        $slugPosition = array_search('slug', $dataKeys);

        return array_merge(
            array_slice($data, 0, $slugPosition),
            [
                'slug' => $data['slug'],
                'url' => $data['url']
            ],
            array_slice($data, $slugPosition + 1, count($dataKeys) - $slugPosition + 2)
        );
    }
}
