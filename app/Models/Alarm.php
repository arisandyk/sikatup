<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alarm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alarms';

    protected $fillable = ['date_log', 'location_id', 'event_id', 'event_type', 'voice'];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    protected $dates = ['date_log'];

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

    public function getEventType()
    {
        // Event type mapping based on your description
        $openKeywords = ['Opened'];
        $closeKeywords = ['Closed'];

        if (!$this->event_type) {
            return 'unknown';  // Default to 'unknown' if event_type is null
        }

        // Check if event_type contains any "Opened" keyword
        foreach ($openKeywords as $keyword) {
            if (stripos($this->event_type, $keyword) !== false) {
                return 'open';
            }
        }

        // Check if event_type contains any "Closed" keyword
        foreach ($closeKeywords as $keyword) {
            if (stripos($this->event_type, $keyword) !== false) {
                return 'close';
            }
        }

        // Return 'undefined' if it's neither open nor close
        return 'undefined';
    }


    public function getDateLogAttribute($value)
    {
        // Jika date_log ada, format; jika tidak, kembalikan 'Unknown Time'
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : 'Unknown Time';
    }
}
