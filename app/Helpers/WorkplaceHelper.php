<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UnitInduk;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\GarduInduk;

class WorkplaceHelper
{
    public static function saveWorkplace($userId, $unitIndukId, $appId, $basecampId, $garduIndukId)
    {
        $user = User::find($userId);
        $unitInduk = UnitInduk::find($unitIndukId);
        $app = App::find($appId);
        $basecamp = Basecamp::find($basecampId);
        $garduInduk = GarduInduk::find($garduIndukId);

        if ($user) {
            $user->current_workplace = sprintf(
                '%s - %s - %s - %s',
                $unitInduk->name,
                $app->name,
                $basecamp->name,
                $garduInduk->name
            );

            $user->last_workplace = $user->current_workplace;
            $user->save();
        }
    }
}
