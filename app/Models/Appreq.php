<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appreq extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'stat_id',
        'permitwork_id',
        'ver_code',
        'date_submitted',
        'date_processed',
        'date_rejected',
        'reason_rejected',
    ];
}
