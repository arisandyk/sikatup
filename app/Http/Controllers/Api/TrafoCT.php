<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trafo\StoreTrafoRequest;
use App\Http\Requests\Trafo\UpdateTrafoRequest;
use App\Models\Trafo;

class TrafoCT extends Controller
{

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Trafo
    {
        return new Trafo();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTrafoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTrafoRequest $request)
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTrafoRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTrafoRequest $request, $id)
    {
        return $this->updateResource($request, $id);
    }
}
