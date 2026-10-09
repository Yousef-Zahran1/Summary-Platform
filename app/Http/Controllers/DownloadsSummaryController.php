<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsSummaryController extends Controller
{
    public function index(Request $request)
    {
        $sort = in_array($request->input('sort'), ['latest', 'oldest'])
            ? $request->input('sort')
            : 'latest';

        $query = auth()->user()
            ->downloads()
            ->with(['user', 'subject.department']) 
            ->withCount(['downloads']);             

        $summaries = $query
            ->orderBy('downloads.created_at', $sort === 'latest' ? 'desc' : 'asc')
            ->paginate(15)
            ->withQueryString();

        return view('downloads', compact('summaries'));
    }
}