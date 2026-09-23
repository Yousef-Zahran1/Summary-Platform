<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\User;


class ProfileTabs extends Component
{
    #[Url(except: 'my-summaries')]
    public $tab = 'my-summaries';
    public User $user ;
    
    
    public function changeTab($newTab)
    {
        $this->tab = $newTab;
    }

    public function render()
    {
        // $user = User::where('id', 1)->first();
        // $summaries = [];

        // if ($this->tab === 'my-summaries') {
        //     $summaries = $user->summaries;
        // }
        // if ($this->tab === 'likes') {
        //     $summaries = $user->likedSummaries()->get();
        // }
        // if ($this->tab === 'saved-summaries') {
        //     $summaries = $user->savedSummaries()->get();
        // }
        // if ($this->tab === 'downloads') {
        //     $summaries = $user->downloads()->get() ; 
        // }
        $user = $this->user;
        $sort = request('sort', 'latest'); 
        
        $query = match ($this->tab) {
            'my-summaries'    => $user->summaries(),
            'likes'           => $user->likedSummaries(),
            'saved-summaries' => $user->savedSummaries(),
            default           => $user->summaries(),
        };
        $query->withCount(['likers', 'downloads']);
        $summariesQuery = match ($sort) {
            'latest' => $query->latest(),
            'oldest' => $query->oldest(),
            'highest_likes' => $query->orderByDesc('likers_count'),
            default  => $query->latest()->get(),
        };
        $summaries = $summariesQuery->paginate(15)->withQueryString();
        return view('livewire.profile-tabs', [
            'summaries'              => $summaries,
            'userSummariesCount'=> $user->summaries->count(),
            'savedCount'        => $user->savedSummaries->count(),
            'likesCount'        => $user->likedSummaries->count(),
            'downloadsCount'    => $user->downloads->count(),
        ]);
    }
}