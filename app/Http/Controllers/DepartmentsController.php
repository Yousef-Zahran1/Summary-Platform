<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentsController extends Controller
{
    public function show(Department $department , Request $request){
        $department->load([
            'subjects.summaries'
        ]);
        $query = $department->summaries()->with(['subject' , 'user' , 'subject.department'])->withCount(['downloads', 'likers']);
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
        return view('departments.show' , compact('department' , 'summaries') );
    }
}
