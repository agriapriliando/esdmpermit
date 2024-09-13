<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['name_topic', 'desc_topic'];

    public function correspondences()
    {
        return $this->hasMany(Correspondence::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name_topic', 'like', $term)
                ->orWhere('desc_topic', 'like', $term);
        });
    }
}
