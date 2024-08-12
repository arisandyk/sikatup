<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\StoreAppRequest;
use App\Http\Requests\App\UpdateAppRequest;
use App\Models\App;

class AppCT extends Controller
{
    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): App
    {
        return new App();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAppRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAppRequest $request)
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAppRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAppRequest $request, int $id)
    {
        return $this->updateResource($request, $id);
    }
}