<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter',
        'planned_hours',
        'plan_id',
        'start_at',
        'end_at',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function isNotEnded(): bool
    {
        return !is_null($this->start_at) && is_null($this->end_at);
    }
}
