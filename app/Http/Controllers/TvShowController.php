<?php

namespace App\Http\Controllers;

use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
            $tvshow->formatted_start_date = Carbon::parse($tvshow->start_date)
                ->locale('lv')
                ->translatedFormat('j. F');
            $tvshow->formatted_end_date = Carbon::parse($tvshow->end_date)
                ->locale('lv')
                ->translatedFormat('j. F');
        }

        // Get all TV shows for deletion dropdown
        $allTvShows = TvShow::orderBy('name')->get();

        return view('dashboard', compact('tvshows', 'allTvShows'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'banner' => 'required|image|mimes:jpeg,jpg,png',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'addTvShow')
                ->withInput();
        }

        $bannerPath = $request->file('banner')->store('banners', 'public');

        TvShow::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'banner' => $bannerPath,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->back()->with('success', 'TV Show added successfully.');
    }

    public function destroy(TvShow $tvshow)
    {
        // Delete the banner image file
        if (Storage::disk('public')->exists($tvshow->banner)) {
            Storage::disk('public')->delete($tvshow->banner);
        }

        $tvshow->delete();

        return redirect()->back()->with('success', 'TV Show deleted successfully.');
    }
}
