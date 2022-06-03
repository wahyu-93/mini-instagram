<?php 

namespace App\Traits;

use App\Models\Like;
use Auth;

trait LikeTrait
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function is_like()
    {
        return $this->likes->where('user_id', Auth::user()->id)->count();
    }
}