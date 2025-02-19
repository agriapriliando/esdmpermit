<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appreq_id',
        'name_doc',
        'type_doc',
        'desc_doc',
        'file_name',
        'sender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
