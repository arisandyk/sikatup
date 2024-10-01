<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GarduInduk\StoreGarduIndukRequest;
use App\Http\Requests\GarduInduk\UpdateGarduIndukRequest;
use App\Models\GarduInduk;
use Illuminate\Http\JsonResponse;

class GarduIndukCT extends Controller
{

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): GarduInduk
    {
        return new GarduInduk();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGarduIndukRequest $request
     * @return JsonResponse
     */
    public function store(StoreGarduIndukRequest $request): JsonResponse
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGarduIndukRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateGarduIndukRequest $request, int $id): JsonResponse
    {
        return $this->updateResource($request, $id);
    }
}