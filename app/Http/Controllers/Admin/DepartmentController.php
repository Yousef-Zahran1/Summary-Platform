<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;


class DepartmentController extends Controller
{
    public function index(){
        return view('admin.departments.index');
    }
    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string|max:2000',
            'icon'        => 'nullable|string|max:100',
        ], [
            'name.required' => 'اسم القسم مطلوب.',
            'name.unique'   => 'يوجد قسم بنفس الاسم بالفعل.',
        ]);

        Department::create($validated);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'تم إنشاء القسم بنجاح.');
    }
}
