<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bay extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bays';

    protected $fillable = [
        'gi_id',
        'name',
        'status',
        'tanggal_operasi',
        'tegangan_id',
        'trafo_id',
        'nomor_series',
        'keterangan',
        'created_by',
        'updated_by',
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

    public function gardu_induks()
    {
        return $this->belongsTo(GarduInduk::class, 'gi_id', 'id');
    }

    public function tegangans()
    {
        return $this->belongsTo(Tegangan::class, 'tegangan_id', 'id');
    }

    public function trafos()
    {
        return $this->belongsTo(Trafo::class, 'trafo_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'bay_id', 'id');
    }
}
