<?php

namespace App\Repositories;

use App\Models\Wage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class WageRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Wage::class;

    /**
     * Find by cpf.
     *
     * @param $cpf
     *
     * @return Employee
     */
    public function findByEmployeeId($employee)
    {
        return Wage::where('employee_id', $employee)->first();
    }
}
