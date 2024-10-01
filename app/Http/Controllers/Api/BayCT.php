<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bay\StoreBayRequest;
use App\Http\Requests\Bay\UpdateBayRequest;
use App\Models\Bay;
use Illuminate\Http\JsonResponse;

class BayCT extends Controller
{

     /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model(): Bay
    {
        return new Bay();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBayRequest $request
     * @return JsonResponse
     */
    public function store(StoreBayRequest $request): JsonResponse
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBayRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBayRequest $request, int $id): JsonResponse
    {
        return $this->updateResource($request, $id);
    }
}
