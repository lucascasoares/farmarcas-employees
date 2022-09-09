<?php

namespace App\Models\Relations;

use App\Models\Wage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyWages
{
    /**
     * Represents a database relationship.
     *
     * @return HasMany|Builder|Wage[]
    */
    public function wages()
    {
        return $this->hasMany(Wage::class);
    }
}
