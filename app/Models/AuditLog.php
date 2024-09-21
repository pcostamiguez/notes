<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
        'ip',
        'sended_info',
        'status',
        'response_code',
        'url',
        'uri',
        'execution_time',
    ];

    protected $casts = [
        'sended_info' => 'array',
    ];
}

