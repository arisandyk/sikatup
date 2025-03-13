<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penghantar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penghantars';

    protected $fillable = [
        'unit_id', 'app_id', 'name', 'created_by','updated_by'
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

    public function unitInduk()
    {
        return $this->belongsTo(UnitInduk::class,'unit_id', 'id');
    }

    public function apps()
    {
        return $this->belongsTo(App::class,'app_id', 'id');
    }

    public function towers() : HasMany {
        return $this->hasMany(Tower::class, 'penghantar_id', 'id');
    }
}
