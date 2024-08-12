<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basecamp\StoreBasecampRequest;
use App\Http\Requests\Basecamp\UpdateBasecampRequest;
use App\Models\Basecamp;
use Illuminate\Http\JsonResponse;

class BasecampCT extends Controller
{
    
    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Basecamp
    {
        return new Basecamp();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBasecampRequest $request
     * @return JsonResponse
     */
    public function store(StoreBasecampRequest $request): JsonResponse
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBasecampRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBasecampRequest $request, int $id): JsonResponse
    {
        return $this->updateResource($request, $id);
    }
}
