<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tegangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tegangans';
    
    protected $fillable = ['name', 'created_by', 'updated_by'];

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
        return $this->hasMany(Bay::class,'tegangan_id');
    }
}
