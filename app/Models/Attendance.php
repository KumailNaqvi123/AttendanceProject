<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status', // e.g., present, absent, leave
        'date',
    ];

    // creates a relationship relationship:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //attendance grade calculation

}

