<?php

namespace App\Http\Controllers;

use App\Models\PlanChapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoadmapChapterController extends Controller
{
    public function __invoke(Request $request, PlanChapter $chapter): RedirectResponse
    {
        abort_if($chapter->plan->user_id !== auth()->id(), 404);

        if ($chapter->isNotStarted()) {
            $chapter->start_at = now();
        } else if ($chapter->isNotEnded()) {
            $chapter->end_at = now();
        }

        $chapter->save();

        return redirect()
            ->route('roadmap.planner.show', $chapter->plan)
            ->with('success', 'Berhasil mengedit chapter.');
    }
}
