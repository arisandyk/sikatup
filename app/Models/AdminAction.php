<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAction extends Model
{
    protected $table = 'admin_actions';
    protected $fillable = [
        'user_id',
        'admin_id',
        'action_type',
        'status',
        'data_before',
        'data_after'
    ];

    protected function casts(): array
    {
        return [
            'data_before' => 'array',
            'data_after' => 'array',
        ];
    }
}
