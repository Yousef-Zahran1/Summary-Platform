<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(20);
        $totalUsersCount = User::count();
        // $activeUsersCount = User::where('deleted_at', null)->count();
        // $deletedUsersCount = User::onlyTrashed()->count();
        $adminsCount = User::where('role', 'admin')->count();
        // $bannedUsersCount = User::where('is_banned', true)->count();

        $users->load('summaries' , 'summaries.subject' , 'summaries.subject.department' , 'basic_department');
        return view('admin.users.index', compact('users', 'totalUsersCount', 'adminsCount'));
    }
}
