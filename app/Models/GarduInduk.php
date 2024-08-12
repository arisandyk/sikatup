<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GarduInduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'gardu_induks';
    
    protected $fillable = [
        'basecamp_id', 'name','created_by','updated_by'
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

    public function basecamps()
    {
        return $this->belongsTo(Basecamp::class, 'basecamp_id');
    }

    public function locations()
    {
        return $this->hasOne(Location::class, 'gi_id');
    }

    public function bays()
    {
        return $this->hasMany(Bay::class, 'gi_id');
    }
}