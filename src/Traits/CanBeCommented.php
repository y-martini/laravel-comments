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
trait CanBeCommented
{
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function comments()
    {
        return $this->morphMany(App::get(Comment::class), 'commentable');
    }
}
