<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Validation\Rule;

class SaveEmployeeRequest extends CrudRequest
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
        return [
            'name' => ['required'],
            'cpf' => ['required'],
            'email' => ['required'],
            'document' => ['required'],
            'birth_date' => ['required'],
            'zip_code' => ['required'],
            'street' => ['required'],
            'number' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'name' => ['string', 'max:255'],
            'cpf' => [Rule::unique('employees', 'cpf')->ignore($this->route('id')), 'regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/'],
            'email' => ['email', Rule::unique('employees', 'email')->ignore($this->route('id'))],
            'document' => ['numeric'],
            'birth_date' => ['date_format:d/m/Y'],
            'zip_code' => [Rule::notIn(['00000-000']), 'regex:/^[0-9]{5}-[0-9]{3}$/'],
            'street' => ['max:255'],
            'number' => ['max:9'],
            'city' => ['max:255'],
            'state' => ['max:2'],
        ];
    }
}
