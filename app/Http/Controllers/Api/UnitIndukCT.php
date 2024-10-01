<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitInduk\StoreUnitIndukRequest;
use App\Http\Requests\UnitInduk\UpdateUnitIndukRequest;
use App\Models\UnitInduk;
use Illuminate\Http\JsonResponse;

class UnitIndukCT extends Controller
{

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): UnitInduk
    {
        return new UnitInduk();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUnitIndukRequest $request
     * @return JsonResponse
     */
    public function store(StoreUnitIndukRequest $request): JsonResponse
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUnitIndukRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUnitIndukRequest $request, int $id): JsonResponse
    {
        return $this->updateResource($request, $id);
    }
}
