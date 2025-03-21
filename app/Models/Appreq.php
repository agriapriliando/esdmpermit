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
        'date_disposisi',
        'user_disposisi',
        'date_processed',
        'user_processed',
        'date_revision',
        'user_revision',
        'date_finished',
        'user_finished',
        'date_rejected',
        'reason_rejected',
        'user_rejected',
        'notes',
        'viewed_operator',
        'viewed_evaluator',
        'viewed_pemohon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function stat()
    {
        return $this->belongsTo(Stat::class);
    }

    public function permitwork()
    {
        return $this->belongsTo(Permitwork::class);
    }

    public function docs()
    {
        return $this->hasMany(Doc::class);
    }

    public function correspondences()
    {
        return $this->hasMany(Correspondence::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('ver_code', 'like', $term)
                ->orWhere('notes', 'like', $term);
        })->orWhereHas('user', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        })->orWhereHas('company', function ($query) use ($term) {
            $query->where('name_company', 'like', $term);
        })->orWhereHas('permitwork', function ($query) use ($term) {
            $query->where('name_permit', 'like', $term);
        });
    }
    public function scopeAdminsearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('ver_code', 'like', $term)
                ->orWhere('notes', 'like', $term);
        })->orWhereHas('user', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        })->orWhereHas('company', function ($query) use ($term) {
            $query->where('name_company', 'like', $term);
        })->orWhereHas('stat', function ($query) use ($term) {
            $query->where('name_stat', 'like', $term);
        })->orWhereHas('permitwork', function ($query) use ($term) {
            $query->where('name_permit', 'like', $term);
        });
    }
}
