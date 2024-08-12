<?php

namespace App\Http\Controllers\Api;

use App\Models\AdminAction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrationCT
{
    public function approveWorker(Request $request, $userId)
    {
        $worker = User::findOrFail($userId);

        // Simpan data sebelum perubahan
        $dataBefore = $worker->toArray();

        // Update status pekerja
        $worker->status = 'approved';
        $worker->save();

        // Simpan data setelah perubahan
        $dataAfter = $worker->toArray();

        // Log tindakan admin
        AdminAction::create([
            'user_id' => $userId,
            'admin_id' => Auth::id(),
            'action_type' => 'approve_registration',
            'status' => 'completed',
            'data_before' => $dataBefore,
            'data_after' => $dataAfter
        ]);

        return response()->json(['message' => 'Worker approved successfully.'], 200);
    }

    public function terminateWorker(Request $request, $userId)
    {
        $worker = User::findOrFail($userId);

        // Simpan data sebelum perubahan
        $dataBefore = $worker->toArray();

        // Update status pekerja
        $worker->status = 'resigned'; // Atau 'terminated' jika Anda ingin menggunakan status ini
        $worker->last_workplace = $request->input('last_workplace'); // Misalnya mengambil tempat kerja terakhir dari request
        $worker->save();

        // Simpan data setelah perubahan
        $dataAfter = $worker->toArray();

        // Log tindakan admin
        AdminAction::create([
            'worker_id' => $userId,
            'admin_id' => Auth::id(),
            'action_type' => 'terminate_job',
            'status' => 'completed',
            'data_before' => $dataBefore,
            'data_after' => $dataAfter
        ]);

        return response()->json(['message' => 'Worker terminated successfully.'], 200);
    }
}
