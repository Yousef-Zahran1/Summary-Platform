<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\Department;

class SummaryController extends Controller
{
    public function index(Request $request){
        $departments = Department::all();
        $allSummaries = Summary::all()->count();
        $departmentsCount = Department::count();
        $subjectsCount = \App\Models\Subject::count();
        $downloadsCount = \DB::table('downloads')->count();
        // $summaries = Summary::with(['subject' , 'user' , 'subject.department'])->withCount(['downloads', 'likers'])->latest()->paginate(15);

        $query = Summary::with(['subject' , 'user' , 'subject.department'])->withCount(['downloads', 'likers']);
        $sort = $request->input('sort', 'latest');
        if($sort === "latest"){
            $query->latest();
        }
        if($sort === "oldest"){
            $query->oldest();
        }
        if($sort === "highest_likes"){
            $query->orderByDesc('likers_count');
        }
        if($sort === "highest_downloads"){
            $query->orderByDesc('downloads_count');
        }
        $summaries = $query->paginate(15)->withQueryString();
        return view('summaries.index' , compact('summaries' , 'departments' , 'departmentsCount' ,'subjectsCount' ,'downloadsCount' ,'allSummaries'));
    }
    
    public function show(Summary $summary){
        return view('summaries.show' ,compact('summary'));
    }
    public function create(){
        $departments = Department::all();
        return view('summaries.create' ,compact('departments'));
    }
    public function store(Request $request){
        $validated =$request->validate([
            'title' => 'required|string|max:255',
            'description' =>'nullable|string',
            'department_id' =>'required|exists:departments,id',
            'subject_id' =>'required|exists:subjects,id',
        ]);
        $validated['user_id'] = 1;
        $validated['file_path'] = "file_path";
        Summary::create($validated);
        // return to_route('summaries.create');
        return back();
    }
    public function edit(){
        return view('summaries.edit');
    }
}
