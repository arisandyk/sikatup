<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TowerAlert extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tower_alerts';

    protected $fillable = [
        'tower_id', 'user_id', 'description'
    ];

    public function tower()
    {
        return $this->belongsTo(Tower::class,'tower_id', 'id');
    }
}
