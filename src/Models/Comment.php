<?php

namespace YuriyMartini\Comments\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use YuriyMartini\Comments\Contracts\Comment as CommentContract;
use YuriyMartini\Comments\Contracts\Commentable;
use YuriyMartini\Comments\Contracts\Commentator;

/**
 * @property Commentable commentable
 * @property Commentator commentator
 * @property string|null text
 * @property Comment|null parent
 * @property Collection children
 */
class Comment extends Model implements CommentContract
{
    public function getCommentable(): Commentable
    {
        return $this->commentable;
    }

    public function getCommentator(): Commentator
    {
        return $this->commentator;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getParent(): ?CommentContract
    {
        return $this->parent;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function commentator()
    {
        return $this->belongsTo(App::get(Commentator::class));
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(App::get(CommentContract::class));
    }

    public function children()
    {
        return $this->hasMany(App::get(CommentContract::class), 'parent_id');
    }
}
