<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'bay_id',
        'obd',
        'cbd',
        'obp',
        'cbp',
        'obr',
        'cbr',
        'obl',
        'cbl',
        'obt',
        'und'
    ];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function cast(): array
    {
        return [
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'deleted_at' => 'timestamp',
        ];
    }

    public function bays()
    {
        return $this->belongsTo(Bay::class, 'bay_id', 'id');
    }

    public function alarms()
    {
        return $this->hasMany(Alarm::class, 'event_id', 'id');
    }

    // Jika Anda ingin memformat date_log saat mengambil data:
    public function getDateLogAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : $this->created_at->format('Y-m-d H:i:s');
    }

    
}
