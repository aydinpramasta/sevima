<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoadmapPlanRequest;
use App\Http\Requests\UpdateRoadmapPlanRequest;
use App\Models\Plan;
use App\Models\PlanChapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoadmapPlannerController extends Controller
{
    public function index(): View
    {
        $plans = Plan::with('user')
            ->whereBelongsTo(auth()->user(), 'user')
            ->paginate(15);

        return view('roadmap.planner.index', compact('plans'));
    }

    public function create(): View
    {
        return view('roadmap.planner.create');
    }

    public function store(StoreRoadmapPlanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $plan = Plan::create([
                'topic' => $data['topic'],
                'user_id' => auth()->id(),
            ]);

            $plan->chapters()->createMany($data['chapters']);
        });

        return redirect()
            ->route('roadmap.planner.index')
            ->with('success', 'Roadmap Plan berhasil dibuat.');
    }

    public function show(Plan $planner): View
    {
        abort_if($planner->user_id !== auth()->id(), 404);

        return view('roadmap.planner.show', compact('planner'));
    }

    public function edit(Plan $planner): View
    {
        abort_if($planner->user_id !== auth()->id(), 404);

        return view('roadmap.planner.edit', compact('planner'));
    }

    public function update(UpdateRoadmapPlanRequest $request, Plan $planner): RedirectResponse
    {
        abort_if($planner->user_id !== auth()->id(), 404);

        $data = $request->validated();

        $planner->update(['topic' => $data['topic']]);

        // update the chapters, if not found create them
        foreach ($data['chapters'] as $key => $val) {
            $data['chapters'][$key]['plan_id'] = $planner->id;
        }

        $planner->chapters()->upsert($data['chapters'], 'id', ['chapter', 'planned_hours']);

        // delete non existent chapters
        $chaptersToBeDeleted = PlanChapter::query()
            ->whereBelongsTo($planner, 'plan')
            ->whereNotIn('id', array_column($data['chapters'], 'id'))
            ->get();

        foreach ($chaptersToBeDeleted as $chapter) {
            if ($chapter->isNotEnded()) continue;

            $chapter->delete();
        }

        return redirect()
            ->route('roadmap.planner.index')
            ->with('success', 'Roadmap Plan berhasil diedit.');
    }

    public function destroy(Plan $planner): RedirectResponse
    {
        foreach ($planner->chapters as $chapter) {
            if ($chapter->isNotEnded()) {
                return back()->withErrors(['chapters' => 'There is a chapter that has not been done yet.']);
            }
        }

        $planner->chapters()->delete();
        $planner->delete();

        return redirect()
            ->route('roadmap.planner.index')
            ->with('success', 'Roadmap Plan berhasil dihapus.');
    }
}
