<?php

namespace App\Http\Controllers;

use App\Models\TvShow;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TvShowController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Retrieve shows with current application dates
        $tvshows = TvShow::whereDate('end_date', '>=', $today)->get();

        // Calculate and format days until offer expires
        foreach ($tvshows as $tvshow) {
            $endDate = Carbon::parse($tvshow->end_date);
            $tvshow->days_left = $today->diffInDays($endDate);
            $tvshow->formatted_start_date = Carbon::parse($tvshow->start_date)->format('d. F');
            $tvshow->formatted_end_date = Carbon::parse($tvshow->end_date)->format('d. F');
        }

        return view('dashboard', compact('tvshows'));
    }
}
