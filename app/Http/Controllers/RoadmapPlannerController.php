<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoadmapPlanRequest;
use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return view('roadmap.planner.show', compact('planner'));
    }

    public function edit(Plan $planner): View
    {
        return view('roadmap.planner.edit', compact('planner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
