<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';
    
    protected $fillable = [
        'gi_id', 'address', 'latitude', 'longitude', 'created_by', 'updated_by'
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

    public function gardu_induks()
    {
        return $this->belongsTo(GarduInduk::class, 'gi_id', 'id');
    }

    public function alarms()
    {
        return $this->hasMany(Alarm::class,'location_id', 'id');
    }
}
