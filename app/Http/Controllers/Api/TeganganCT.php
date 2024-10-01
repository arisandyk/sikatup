<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tegangan\StoreTeganganRequest;
use App\Http\Requests\Tegangan\UpdateTeganganRequest;
use App\Models\Tegangan;

class TeganganCT extends Controller
{

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Tegangan
    {
        return new Tegangan();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeganganRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTeganganRequest $request)
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeganganRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTeganganRequest $request, $id)
    {
        return $this->updateResource($request, $id);
    }
}
