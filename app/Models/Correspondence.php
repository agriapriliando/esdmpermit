<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correspondence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'appreq_id',
        'desc',
        'viewed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
