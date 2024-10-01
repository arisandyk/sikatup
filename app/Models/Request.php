<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_type',
        'old_value',
        'new_value',
        'status', // 'pending', 'approved', 'rejected'
        'admin_response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
