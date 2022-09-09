<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

abstract class CrudController extends Controller
{

    use ValidatesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->validate($this->formRequest(), $this->formRequest()->rules());

        if ($resource = $this->getRepository()->create($request->input())) {
            return $this->afterCreate($resource);
        }

        return $this->afterFailed('created');
    }

    /**
     * Update the specified resource.
     *
     * @param int $id
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($this->formRequest(), $this->formRequest()->rules());

        $instance = $this->getRepository()->find($id);

        if (!$instance) {
            return $this->notFound();
        }

        if ($resource = $this->getRepository()->update($instance, $request->input())) {
            return $this->afterUpdate($resource);
        }

        return $this->afterFailed('updated');
    }

    /**
     * List resources.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $resources = $this->getRepository()->index($request->all());
        
        if ($resources->count()) {
            return $this->collectionResource($resources);
        }

        return $this->notFound();
    }

    /**
     * Show resource.
     *
     * @param Request $request
     * @return array
     */
    public function show(Request $request)
    {
        $id = $request->route('id');

        $resource = $this->getRepository()->find($id);

        if ($resource) {
            return $this->modelResource($resource);
        }

        return $this->notFound();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        $instance = $this->getRepository()->find($id);

        if (!$instance) {
            return $this->notFound();
        }

        if ($success = $this->getRepository()->delete($instance)) {
            return $this->afterDelete($instance);
        }

        return $this->afterFailed('deleted');
    }

    /**
     * Get repository instance.
     *
     * @return Repository
     */
    protected function getRepository() {
        return app($this->repositoryType);
    }

    /**
     * Collection resource.
     *
     * @param $collection
     * @return mixed
     */
    protected function collectionResource($collection)
    {
        ResourceCollection::withoutWrapping();

        return new ResourceCollection($collection);
    }

    /**
     * Model resource
     *
     * @param $model
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    protected function modelResource($model)
    {
        JsonResource::withoutWrapping();

        return new JsonResource($model);
    }

    protected function notFound()
    {
        return response()->json([
            'message' => "The server can not find the requested resource."
        ], 404);
    }

    /**
     * Where to redirect after creating the resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterCreate($resource)
    {
        return response()->json([
            'message' => sprintf(
                "%s created successful",
                class_basename($this->resourceType)
            )
        ], 200);
    }

    /**
     * Where to redirect after creating the resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterUpdate($resource)
    {
        return response()->json([
            'message' => sprintf(
                "%s updated successful",
                class_basename($this->resourceType)
            )
        ], 200);
    }

    protected function afterDelete($instance)
    {
        return response()->json([
                'message' => sprintf(
                    "%s deleted successful",
                    class_basename($this->resourceType)
                )
            ], 200);
    }

    /**
     * Returns the request that should be used to validate.
     *
     * @return FormRequest
     */
    protected function formRequest()
    {
        return request();
    }

    /**
     * Attributes to fill on model.
     *
     * @return array
     */
    public function formParams()
    {
        return $this->formRequest()->params();
    }
}
