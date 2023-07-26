<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,  
            "user_id"=>$this->user_id,  
            "title"=>$this->title,  
            "content"=>$this->content,  
            "created_at"=>$this->created_at->diffForHumans(),
            "image" => $this->image,
            "comments_count" => $this->comments_count,
            "user"=>new postUserResource($this->whenLoaded('user'))
        ];
    }
}
