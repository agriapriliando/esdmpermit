<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permitwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_permit',
        'desc_permit'
    ];

    public function appreqs()
    {
        return $this->hasMany(Appreq::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name_permit', 'like', $term)
                ->orWhere('desc_permit', 'like', $term);
        });
    }
}
