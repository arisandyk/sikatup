<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdminUpdateRequest;
use App\Models\User;

class UserCT extends Controller
{

    /**
     * Get the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model(): User
    {
        return new User();
    }

    /**
     * Update a user by admin.
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        return $this->updateResource($request, $id);
    }
}
