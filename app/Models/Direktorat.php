<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direktorat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'direktorat';
    protected $fillable = ['name', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function cast(): array
    {
        return [
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'deleted_at' => 'timestamp',
        ];
    }

    public function unit_induks()
    {
        return $this->hasMany(UnitInduk::class,'direktorat_id');
    }
}
