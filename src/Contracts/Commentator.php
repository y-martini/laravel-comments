<?php

namespace YuriyMartini\Comments\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Commentator
{
    /**
     * @return string
     */
    public function getTable();

    public function getComments(): Collection;
}
