<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Subject;


class SubjectController extends Controller
{
    public function index(){
        return view('admin.subjects.index');
    }
    public function create()
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.subjects.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'code'          => 'required|string|max:50|unique:subjects,code',
            'department_id' => 'required|exists:departments,id',
        ], [
            'name.required'          => 'اسم المادة مطلوب.',
            'code.required'          => 'كود المادة مطلوب.',
            'code.unique'            => 'يوجد مادة بنفس الكود بالفعل.',
            'department_id.required' => 'القسم مطلوب.',
            'department_id.exists'   => 'القسم المختار غير موجود.',
        ]);

        Subject::create($validated);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'تم إنشاء المادة بنجاح.');
    }
}
