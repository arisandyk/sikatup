<?php

namespace App\Observers;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

class GeneralObserver
{
    public function created($model)
    {
        $this->logAction('create', $model);
    }

    public function updated($model)
    {
        $this->logAction('update', $model);
    }

    public function deleted($model)
    {
        $this->logAction('delete', $model);
    }

    protected function logAction($actionType, $model)
    {
        AuditTrail::create([
            'user_id' => Auth::id(),
            'action_type' => $actionType,
            'action_details' => json_encode([
                'table' => $model->getTable(),
                'data' => $model->toArray(),
                'changes' => $actionType === 'update' ? $model->getChanges() : null,
                'original' => $actionType === 'update' ? $model->getOriginal() : null,
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
