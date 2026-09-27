<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\User;



class DashboardController extends Controller
{
    public function index(){
        $summaries = Summary::latest()->paginate(20);
        $summaries->load('user', 'subject', 'subject.department');
        // dd($summaries);
        return view('admin.dashboard' , compact('summaries'));
    }
}
