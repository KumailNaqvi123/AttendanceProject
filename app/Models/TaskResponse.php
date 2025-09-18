<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskResponse extends Model
{
    use HasFactory;

    // Allow mass assignment for all relevant fields
    protected $fillable = [
        'task_id',
        'user_id',
        'response',
        'status',
        'feedback',
        'file_id',   // Google Drive file path / ID
        'file_name', // Original file name
    ];

    // Belongs to the task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Belongs to the user (who submitted response)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

