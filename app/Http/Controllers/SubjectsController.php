<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class SubjectsController extends Controller
{
    public function show(Subject $subject){
        return view('subjects.show', compact('subject'));
    }
}
