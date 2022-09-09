<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Validation\Rule;

class SaveWageRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Employee::class;

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [];
    }

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'amount' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'employee_id' => ['required', Rule::exists('employees', 'id')]
        ];
    }
}
