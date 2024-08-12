<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basecamp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'basecamps';
    
    protected $fillable = [
        'app_id', 'name', 'created_by','updated_by'
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

    public function apps()
    {
        return $this->belongsTo(App::class,'app_id');
    }

    public function gardu_induks()
    {
        return $this->hasMany(GarduInduk::class,'gi_id');
    }
}
