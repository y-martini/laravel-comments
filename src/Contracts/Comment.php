<?php

namespace YuriyMartini\Comments\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Comment
{
    /**
     * @return string
     */
    public function getTable();

    public function getCommentable(): Commentable;

    public function getCommentator(): Commentator;

    public function getText(): ?string;

    public function getParent(): ?Comment;

    public function getChildren(): Collection;
}
