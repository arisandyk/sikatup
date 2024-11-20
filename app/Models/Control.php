<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'controls';

    protected $fillable = [
        'bay_id',
        'obd',
        'cbd',
        'obp',
        'cbp',
        'obr',
        'cbr',
        'obl',
        'cbl',
        'obt',
        'und',
        'reset_by'
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

    public function bay()
    {
        return $this->belongsTo(Bay::class, 'bay_id', 'id');
    }
}
