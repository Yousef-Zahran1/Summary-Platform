<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary; 
use App\Models\User; 
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class SummaryController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $allSummaries = Summary::all()->count();
        $departmentsCount = Department::count();
        $subjectsCount = \App\Models\Subject::count();
        $downloadsCount = \DB::table('downloads')->count();
        $studentCount = User::where('role' , 'student')->count();



        return view('summaries.index', compact( 'departments', 'departmentsCount', 'subjectsCount', 'downloadsCount', 'allSummaries' ,'studentCount'));
    }

    public function show(Summary $summary)
    {
        if($summary->status !== 'accepted'){
            if($summary->user_id === auth()->id() || auth()->user()->role === 'admin'){
                $summary->loadCount('downloads');
                return view('summaries.show', compact('summary'));
            }
            else{
                return back();
            }
        }
        $summary->loadCount('downloads');
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
            $file = $request->file('summary_file');
            $path = $file->store('summaries', 'public');

            Summary::create([
                'title'            => $validated['title'],
                'description'      => $validated['description'] ?? null,
                'department_id'    => $validated['department_id'],
                'subject_id'       => $validated['subject_id'],
                'user_id'          => auth()->id(),
                'file_path'        => $path,
                'file_size'        => $file->getSize(), 
                'submission_token' => $validated['submission_token'],
            ]);

            return to_route('profile.show', auth()->id())
                ->with('success', 'تم إرسال الملخص للمراجعة بنجاح.');

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return to_route('profile.show', auth()->id())
                    ->with('success', 'تم إرسال الملخص للمراجعة بالفعل.');
            }
            throw $e;
        }
    }


    public function restore($id)
    {
        $summary = Summary::onlyTrashed()->findOrFail($id);

        if ($summary->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك باستعادة هذا الملخص.');
        }

        $summary->restore();

        $summary->update(['deleted_by' => null]);

        return back()->with('success', 'تم استعادة الملخص بنجاح.');
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
        if (url()->previous() === route('summaries.show', $summary->id)) {
            return redirect()->route('profile.show', auth()->id())->with('success', 'تم حذف الملخص بنجاح.');
        }
        return back()->with('success', 'تم حذف الملخص بنجاح.');
    }


    public function download(Summary $summary)
    {
        if (!$summary->file_path || !Storage::disk('public')->exists($summary->file_path)) {
            abort(404, 'الملف غير موجود.');
        }

        \DB::table('downloads')->insert([
            'user_id'    => auth()->id(),
            'summary_id' => $summary->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        $extension = pathinfo($summary->file_path, PATHINFO_EXTENSION);

    $fileName = $summary->title . '.' . $extension;

    return Storage::disk('public')->download($summary->file_path, $fileName);
    }
}
