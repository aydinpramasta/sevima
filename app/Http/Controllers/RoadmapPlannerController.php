<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoadmapPlanRequest;
use App\Models\Plan;
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

    public function store(StoreRoadmapPlanRequest $request)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
