<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UnitInduk;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\GarduInduk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveWorkplaceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $unitIndukId;
    protected $appId;
    protected $basecampId;
    protected $garduIndukId;

    public function __construct($userId, $unitIndukId, $appId, $basecampId, $garduIndukId)
    {
        $this->userId = $userId;
        $this->unitIndukId = $unitIndukId;
        $this->appId = $appId;
        $this->basecampId = $basecampId;
        $this->garduIndukId = $garduIndukId;
    }

    public function handle()
    {
        $user = User::find($this->userId);
        $unitInduk = UnitInduk::find($this->unitIndukId);
        $app = App::find($this->appId);
        $basecamp = Basecamp::find($this->basecampId);
        $garduInduk = GarduInduk::find($this->garduIndukId);

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
