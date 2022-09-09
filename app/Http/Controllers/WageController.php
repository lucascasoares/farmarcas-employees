<?php

namespace App\Http\Controllers;

use App\Models\Wage;
use App\Repositories\WageRepository;
use App\Http\Requests\SaveWageRequest;

class WageController extends CrudController
{

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Wage::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = WageRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return FormRequest
     */
    protected function formRequest()
    {
        return app(SaveWageRequest::class);
    }
}
