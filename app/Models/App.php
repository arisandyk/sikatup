<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'apps';

    protected $fillable = [
        'unit_id', 'name', 'created_by','updated_by'
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

    public function unit_induks()
    {
        return $this->belongsTo(UnitInduk::class,'unit_id');
    }

    public function basecamps()
    {
        return $this->hasMany(Basecamp::class,'app_id');
    }
}