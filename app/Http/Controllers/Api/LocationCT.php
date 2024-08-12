<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class LocationCT extends Controller
{

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Location
    {
        return new Location();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLocationRequest $request
     * @return JsonResponse
     */
    public function store(StoreLocationRequest $request): JsonResponse
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLocationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateLocationRequest $request, int $id): JsonResponse
    {
        return $this->updateResource($request, $id);
    }
}
