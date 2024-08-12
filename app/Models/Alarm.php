<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alarm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alarms';

    protected $fillable = ['date_log', 'location_id', 'event_id', 'voice'];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    protected function cast(): array
    {
        return [
            'date_log' => 'timestamp',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'deleted_at' => 'timestamp',
        ];
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
