<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Direktorat\StoreDirektoratRequest;
use App\Http\Requests\Direktorat\UpdateDirektoratRequest;
use App\Models\Direktorat;

class DirektoratCT extends Controller
{
    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): Direktorat
    {
        return new Direktorat();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDirektoratRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDirektoratRequest $request)
    {
        return $this->storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDirektoratRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDirektoratRequest $request, int $id)
    {
        return $this->updateResource($request, $id);
    }
}
