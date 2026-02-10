<?php

namespace App\Traits;

trait PreventsDeletion
{
    // protected array $blockDeleteIfHas = [];

    public function canBeDeleted(): bool
    {
        foreach ($this->blockDeleteIfHas as $relation) {
            if ($this->{$relation}()->exists()) {
                return false;
            }
        }

        return true;
    }
}
