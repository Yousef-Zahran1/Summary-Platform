<?php

namespace App\Http\Controllers;

use App\Models\Department;

class DepartmentsController extends Controller
{
    public function show(Department $department)
    {
        $department->load([
            'subjects.summaries'
        ]);
        return view('departments.show', compact('department'));
    }
}
