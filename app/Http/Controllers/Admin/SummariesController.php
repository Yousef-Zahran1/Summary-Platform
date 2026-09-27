<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Summary;

class SummariesController extends Controller
{
    public function index(){
        $summaries = Summary::with('user', 'subject', 'subject.department')->latest()->paginate(20);
        return view('admin.summaries.index', compact('summaries'));
    }
}
