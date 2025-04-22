<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tower extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'towers';

    protected $fillable = [
        'penghantar_id', 'name', 'no', 'alamat', 'latitude', 'longitude', 'created_by','updated_by'
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

    public function penghantar()
    {
        return $this->belongsTo(Penghantar::class, 'penghantar_id', 'id');
    }
}
