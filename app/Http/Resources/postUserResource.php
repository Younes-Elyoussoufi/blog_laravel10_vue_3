<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class postUserResource extends JsonResource
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
            "name"=>$this->name,
            "email"=>$this->when(auth()->check() ? auth()->user()->is_admin :false,$this->email)
            // "email"=>$this->when(false,$this->email,'defaltEmail@gmail.com')
        ];
    }
}
