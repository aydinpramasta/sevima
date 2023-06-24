<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $unfinishedChapters = Plan::query()
            ->withWhereHas('chapters', function ($query) {
                $query->whereNot('start_at', null)
                    ->where('end_at', null);
            })
            ->whereBelongsTo(auth()->user(), 'user')
            ->latest()
            ->paginate(5);

        return view('dashboard', compact('unfinishedChapters'));
    }
}
