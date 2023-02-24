<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'id_category' => $this->id_category,
            'id_user' => $this->id_user,
            'visibility' => $this->visibility,
            'archived' => $this->archived,
            'created_at' => $this->created_at,
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
            'archived_at' => $this->archived_at,
            'validated_at' => $this->validated_at,
        ];
    }
}
