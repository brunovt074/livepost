<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * - Resource class helps us to manage our API JSON response in one place.
 * - It makes our API response to be more consistent and maintainable.
 * - We can use the php artisan make:resource command to generate the resource boilerplate
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
