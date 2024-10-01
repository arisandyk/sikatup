<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trafo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trafos';
    
    protected $fillable = ['name_plate', 'deklarasi', 'available', 'created_by', 'updated_by'];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function cast(): array
    {
        return [
            'id' => 'integer',
            'name_plate' => 'string',
            'deklarasi' => 'string',
            'available' => 'boolean',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'deleted_at' => 'timestamp',
        ];
    }

    public function bays()
    {
        return $this->hasMany(Bay::class, 'trafo_id');
    }
}
