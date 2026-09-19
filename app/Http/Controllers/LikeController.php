<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;

class LikeController extends Controller
{
    public function toggle(Summary $summary){
        $summary->likers()->toggle(1);

        return to_route('summaries.index');
    }
}
