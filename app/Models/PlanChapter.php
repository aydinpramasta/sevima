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

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function isNotStarted(): bool
    {
        return is_null($this->start_at) && is_null($this->end_at);
    }

    public function isNotEnded(): bool
    {
        return !is_null($this->start_at) && is_null($this->end_at);
    }

    public function getStartDiff(): string
    {
        return $this->start_at
            ->addHours($this->planned_hours)
            ->timezone('Asia/Jakarta')
            ->locale('id')
            ->longRelativeToNowDiffForHumans();
    }
}
