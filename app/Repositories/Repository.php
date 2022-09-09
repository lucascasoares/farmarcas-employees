<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

abstract class Repository
{

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType;

    /**
     * Eloquent instance for helper methods.
     *
     * @var Model
     */
    protected $resourceInstance;

    /**
     * Repository constructor.
     *
     * @param string $resourceType
     */
    public function __construct($resourceType = null)
    {
        if ($resourceType) {
            $this->resourceType = $resourceType;
        }
    }

    /**
     * Get resource instance.
     *
     * @return Model
     */
    public function getInstance()
    {
        if (is_null($this->resourceInstance)) {
            $this->resourceInstance = new $this->resourceType;
        }

        return $this->resourceInstance;
    }

    /**
     * Get table name for resource type.
     *
     * @return string
     */
    protected function getTable()
    {
        return $this->getInstance()
            ->getTable();
    }

    /**
     * Create a new query for the resource.
     *
     * @return Builder|Model
     */
    protected function newQuery()
    {
        return $this->getInstance()
            ->newQuery();
    }

    /**
     * Fills data to the resource.
     *
     * @param Model $resource
     * @param array $attributes
     * @param bool $force
     * @return Model
     */
    public function fill($resource, $attributes, $force = false)
    {
        $resource->fillable(
            $force && empty($resource->getFillable())
                ? $resource->getAllFillable()
                : $resource->getFillable()
        );
        $resource->fill($attributes);

        return $resource;
    }

    /**
     * Build a new object without saving.
     *
     * @param array $attributes
     * @param bool $force
     * @return Model
     */
    public function build($attributes, $force = false)
    {
        return $this->fill(
            $this->getInstance(),
            $attributes,
            $force
        );
    }
}
