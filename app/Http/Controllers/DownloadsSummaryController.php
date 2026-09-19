<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DownloadsSummaryController extends Controller
{
    public function index(Request $request){
        $sort = $request->input('sort' , 'latest');
        $query = User::findOrfail(1)->downloads();
        if($sort === "latest"){
            $summaries = $query->latest()->paginate(20);
        }
        if($sort === "oldest"){
            $summaries = $query->oldest()->paginate(20);
        }
            
        return view('downloads' , compact('summaries'));
    }
}
