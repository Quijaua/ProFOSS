<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'url',
        'owner',
        'full_name',
    ];

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
