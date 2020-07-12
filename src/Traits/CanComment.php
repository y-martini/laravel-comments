<?php

namespace YuriyMartini\Comments\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use YuriyMartini\Comments\Contracts\Comment;

/**
 * @mixin Model
 * @property-read Collection comments
 */
trait CanComment
{
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function comments()
    {
        return $this->hasMany(App::get(Comment::class), 'commentator_id');
    }
}
