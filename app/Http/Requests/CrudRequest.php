<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class CrudRequest extends FormRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = 'App\\Models\\Model';

    /**
     * Params
     *
     * @return array
     */
    public function params()
    {
        return $this->all();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge_recursive($this->baseRules(),
            $this->isMethod('patch')
                ? $this->editRules()
                : $this->createRules()
        );
    }

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
    abstract protected function baseRules();
}
