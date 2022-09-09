<?php

namespace App\Models\Relations;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToEmployee
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder|Employee[]
    */
    public function employee()
    {
        return $this->BelongsTo(Employee::class);
    }
}
