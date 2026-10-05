<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\Department;
use Illuminate\Database\QueryException;

class SummaryController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $allSummaries = Summary::all()->count();
        $departmentsCount = Department::count();
        $subjectsCount = \App\Models\Subject::count();
        $downloadsCount = \DB::table('downloads')->count();



        return view('summaries.index', compact( 'departments', 'departmentsCount', 'subjectsCount', 'downloadsCount', 'allSummaries'));
    }

    public function show(Summary $summary)
    {
        if($summary->status !== 'accepted'){
            if($summary->user_id === auth()->id() || auth()->user()->role === 'admin'){
                return view('summaries.show', compact('summary'));
            }
            else{
                return back();
            }
        }
        return view('summaries.show', compact('summary'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('summaries.create', compact('departments'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'department_id'    => 'required|exists:departments,id',
            'subject_id'       => 'required|exists:subjects,id',
            'summary_file'     => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:25600',
            'submission_token' => 'required|uuid',
        ]);

        try {
            Summary::create([
                'title'            => $validated['title'],
                'description'      => $validated['description'] ?? null,
                'department_id'    => $validated['department_id'],
                'subject_id'       => $validated['subject_id'],
                'user_id'          => auth()->id(),
                'file_path'        => $request->file('summary_file')->store('summaries', 'public'),
                'submission_token' => $validated['submission_token'],
            ]);

            return to_route('profile.show' , auth()->id())
                ->with('success', 'تم إرسال الملخص للمراجعة بنجاح.');

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return to_route('profile.show' , auth()->id())
                    ->with('success', 'تم إرسال الملخص للمراجعة بالفعل.');
            }
            throw $e;
        }

    }

    public function edit(Summary $summary)
    {
        $departments = Department::all();
        return view('summaries.edit', compact('summary', 'departments'));
    }

    public function update(Request $request, Summary $summary)
    {
        $validated = $request->validate([
            'title' => "required|string|max:255",
            'description' => "nullable|string",
            'department_id' => 'required|exists:departments,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $summary->update($validated);
        return to_route('profile.show' , auth()->id())->with('success', 'تم تعديل الملخص بنجاح.');
    }
    public function destroy(Summary $summary)
    {
        $summary->delete();
        return back()->with('success', 'تم حذف الملخص بنجاح.');
    }
}
