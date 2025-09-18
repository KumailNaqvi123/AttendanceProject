<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'user_id',
        'content',
        'status',
        'file_id',     // ✅ allow saving file_id
        'file_name',   // ✅ allow saving file_name
    ];

    // The admin who assigned the task
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // The user who is assigned the task
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The response to this task
    public function response()
    {
        return $this->hasOne(TaskResponse::class);
    }
}
