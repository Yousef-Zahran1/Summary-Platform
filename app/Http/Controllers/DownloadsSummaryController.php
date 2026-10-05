<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsSummaryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'latest');
        $query = auth()->user()->downloads();
        if ($sort === "latest") {
            $summaries = $query->latest()->paginate(20);
        }
        if ($sort === "oldest") {
            $summaries = $query->oldest()->paginate(20);
        }

        return view('downloads', compact('summaries'));
    }
}
