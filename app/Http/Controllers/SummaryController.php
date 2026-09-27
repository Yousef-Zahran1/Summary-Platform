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
        $search = $request->input('search');

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' =>'nullable|string',
            'department_id' =>'required|exists:departments,id',
            'subject_id' =>'required|exists:subjects,id',
        ]);
        $validated['user_id'] = auth()->id();
        $validated['file_path'] = "file_path";
        Summary::create($validated);
        return to_route('summaries.index')->with('success', 'تم إضافة الملخص بنجاح.');
        // return back();
    }
    
    public function edit(Summary $summary){
        $departments = Department::all();
        return view('summaries.edit' , compact('summary', 'departments'));
    }
    
    public function update(Request $request , Summary $summary){
        $validated = $request->validate([
            'title' => "required|string|max:255",
            'description' => "nullable|string",
            'department_id' =>'required|exists:departments,id',
            'subject_id' =>'required|exists:subjects,id',
        ]);
        $summary->update($validated);
        return to_route('summaries.show', $summary->id )->with('success', 'تم تعديل الملخص بنجاح.');
    }
    public function destroy(Summary $summary){
        $summary->delete();
        return to_route('summaries.index')->with('success', 'تم حذف الملخص بنجاح.');
    }
}
