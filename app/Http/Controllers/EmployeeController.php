<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Http\Requests\FormRequest;
use App\Http\Requests\SaveEmployeeRequest;

class EmployeeController extends CrudController
{

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Employee::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = EmployeeRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return FormRequest
     */
    protected function formRequest()
    {
        return app(SaveEmployeeRequest::class);
    }
}
