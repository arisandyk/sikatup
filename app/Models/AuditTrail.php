<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $table = 'audit_trails';
    protected $fillable = [
        'user_id',
        'action_type',
        'action_details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}