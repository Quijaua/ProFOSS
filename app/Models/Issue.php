<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'url',
        'state',
        'repository_id',
        'project_id',
    ];

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
