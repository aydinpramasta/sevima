<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
