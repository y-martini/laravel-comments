<?php

namespace YuriyMartini\Comments\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Commentable
{
    public function getComments(): Collection;
}
