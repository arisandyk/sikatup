<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sender extends Model
{
    use HasUuids;

    public function notificationTrackers() : HasMany {
        return $this->hasMany(NotificationTracker::class, 'sender_id', 'id');
    }
}
