<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'caption'       => $this->caption,
            'image'         => $this->image,
            'created_at'    => $this->created_at->diffForhumans(),
            'likes_count'   => $this->likes_count,
            'comments_count'   => $this->comments_count,
            'user'          => $this->user,
            'is_like'       => $this->is_like() ? 'Unlike' : 'Like',
            'is_like_btn'   => $this->is_like() ? 'btn-danger' : 'btn-primary',
            'post_time'     => strtotime($this->created_at)
        ];
    }
}
