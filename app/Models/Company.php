<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appreqs()
    {
        return $this->hasMany(Appreq::class);
    }



    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name_company', 'like', $term)
                ->orWhere('npwp_company', 'like', $term);
        })->orWhereHas('user', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }
}
