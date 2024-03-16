<?php

namespace App\Models;

use App\Observers\IssueObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Overtrue\LaravelVote\Traits\Votable;

#[ObservedBy([IssueObserver::class])]
class Issue extends Model
{
    use HasFactory;
    use Votable;

    protected $fillable = [
        'title',
        'body',
        'url',
        'state',
        'repository_id',
        'project_id',
        'created_by',
    ];

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
