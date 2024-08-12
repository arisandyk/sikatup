<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

abstract class Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return ResponseResource::error('Unauthorized', 401);
        }
        try {
            $data = $this->model()::all();
            $modelName = class_basename($this->model());
            return ResponseResource::success("List data {$modelName}", $data);
        } catch (\Exception $e) {
            Log::error('Index method failed: ' . $e->getMessage());
            return ResponseResource::error('Failed to fetch data', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function storeResource($request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['created_by'] = $request->user()->name;

            $data = $this->model()::create($validatedData);
            $modelName = class_basename($this->model());

            return ResponseResource::success("{$modelName} data successfully created", $data);
        } catch (\Exception $e) {
            Log::error('Store method failed: ' . $e->getMessage());
            return ResponseResource::error('Failed to create data', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = $this->model()::find($id);

            if (!$data) {
                return ResponseResource::error('Data not found', 404);
            }

            $modelName = class_basename($this->model());
            return ResponseResource::success("Details of {$modelName}", $data);
        } catch (\Exception $e) {
            Log::error('Show method failed: ' . $e->getMessage());
            return ResponseResource::error('Failed to fetch data', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateResource($request, int $id): JsonResponse
    {
        try {
            $data = $this->model()::find($id);

            if (!$data) {
                return ResponseResource::error('Data not found', 404);
            }

            $validatedData = $request->validated();
            $validatedData['updated_by'] = $request->user()->name;
            $data->update($validatedData);

            $modelName = class_basename($this->model());

            return ResponseResource::success("{$modelName} data successfully updated", $data);
        } catch (\Exception $e) {
            Log::error('Update method failed: ' . $e->getMessage());
            return ResponseResource::error('Failed to update data', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $data = $this->model()::find($id);

            if (!$data) {
                return ResponseResource::error('Data not found', 404);
            }

            $data->delete();
            $modelName = class_basename($this->model());
            return ResponseResource::success("{$modelName} successfully deleted", null);
        } catch (\Exception $e) {
            Log::error('Destroy method failed: ' . $e->getMessage());
            return ResponseResource::error('Failed to delete data', 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        try {
            $data = $this->model()::withTrashed()->find($id);

            if (!$data) {
                return ResponseResource::error('Data not found', 404);
            }

            $data->restore();
            $modelName = class_basename($this->model());
            return ResponseResource::success("{$modelName} successfully restored", $data);
        } catch (\Exception $e) {
            Log::error('Restore method failed: ' . $e->getMessage());
            return ResponseResource::error('Failed to restore data', 500);
        }
    }

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract protected function model(): Model;
}
