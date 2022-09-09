<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Wage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class EmployeeRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Employee::class;

    /**
     * Filter attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function filterAttributes($attributes)
    {
        if (is_null(data_get($attributes, 'email'))) {
            unset($attributes['email']);
        } else {
            $attributes['email'] = strtolower($attributes['email']);
        }

        if (is_null(data_get($attributes, 'birth_date'))) {
            unset($attributes['birth_date']);
        } else {
            $attributes['birth_date'] = now()->createFromFormat('d/m/Y', $attributes['birth_date']);
        }

        return $attributes;
    }

    /**
     * Find by cpf.
     *
     * @param $cpf
     *
     * @return Employee
     */
    public function findByCpf($cpf)
    {
        return Employee::where('cpf', $cpf)->first();
    }
}
