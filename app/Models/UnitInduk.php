<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitInduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit_induks';
    protected $fillable = [
        'direktorat_id', 'name', 'created_by', 'updated_by'
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

    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'direktorat_id','id');
    }

    public function apps()
    {
        return $this->hasMany(App::class, 'unit_id','id');
    }
}
