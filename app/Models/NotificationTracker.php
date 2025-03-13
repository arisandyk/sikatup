<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationTracker extends Model
{
    use HasUuids;

    protected $fillable = [
        'sender_id',
        'data_id',
        'type',
        'status',
        'request',
        'success',
        'error'
    ];

    public function sender() : BelongsTo {
        return $this->belongsTo(Sender::class, 'sender_id', 'id');
    }
}
