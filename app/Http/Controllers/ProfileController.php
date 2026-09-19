<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request){
        $user = User::findorfail(1);
        $savedSummaries = $user->savedSummaries()->get();
        $likedSummaries = $user->likedSummaries()->get();
        $downloadSummaries = $user->downloads()->get();
        $query = Summary::where('user_id' , 1)->with(['subject' , 'user' , 'subject.department'])->withCount(['downloads', 'likers']);
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
        return view('profile' , compact('summaries' , 'user' ,'savedSummaries' ,'likedSummaries','downloadSummaries'));
    }
}
