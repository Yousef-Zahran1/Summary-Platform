<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Summary;

class ProfileTabs extends Component
{
    use WithPagination;
    #[Url(history: true , except: 'my-summaries')]
    public $tab = 'my-summaries';

    #[Url(history: true , except: 'latest')]
    public $sort = 'latest';

    #[Url(except: 1)]
    public $page = 1;

    public $search = '';
    
    public function updatedSort()
    {
        $this->resetPage();
    }
    public User $user ;
    
    
    public function changeTab($newTab)
    {
        $this->tab = $newTab;
        $this->sort = 'latest';
        $this->resetPage();
    }

    #[On('restoreSummary')]
    public function restoreSummary($id)
    {
        $summary = Summary::onlyTrashed()
            ->where('user_id', auth()->id())
            ->where('deleted_by', auth()->id())
            ->findOrFail($id);

        $summary->restore();
        $summary->update(['deleted_by' => null]);

        $this->dispatch('notify', type: 'success', message: 'تم استعادة الملخص بنجاح.');
    }

    #[On('forceDeleteSummary')]
    public function forceDeleteSummary($id)
    {
        $summary = Summary::onlyTrashed()
            ->where('user_id', auth()->id())
            ->where('deleted_by', auth()->id())
            ->findOrFail($id);

        $summary->forceDelete();

        $this->dispatch('notify', type: 'success', message: 'تم حذف الملخص نهائياً.');
    }


    public function render()
    {
        $user = $this->user;
        $query = match ($this->tab) {
            'my-summaries'    => $user->summaries()->where('status' , 'accepted'),
            'likes'           => $user->likedSummaries(),
            'saved-summaries' => $user->savedSummaries(),
            'pending-summaries' => $user->summaries()->where('status' , 'pending'),
            'rejected-summaries'  => $user->summaries()->where('status', 'rejected'),
            'trashed-summaries' => $user->summaries()->onlyTrashed()->where('deleted_by', $user->id),
            default           => $user->summaries(),
        };
        $query->withCount(['likers', 'downloads']);

        $search = $this->search;
        if($search){
            $query->where(function ($query) use($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orwhere('description', 'like', "%{$search}%")
                    ->orWhereHas('subject', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('subject.department', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $sort = $this->sort;
        $summariesQuery = match ($sort) {
            'latest' => $query->latest(),
            'oldest' => $query->oldest(),
            'highest_likes' => $query->orderByDesc('likers_count'),
            'highest_downloads' => $query->orderByDesc('downloads_count'),
            default  => $query->latest(),
        };


        $summaries = $summariesQuery->paginate(15)->withQueryString();
        return view('livewire.profile-tabs', [
            'summaries'              => $summaries,
            'userSummariesCount'=> $user->summaries->where('status' , 'accepted')->count(),
            'pendingSummariesCount'=> $user->summaries->where('status' , 'pending')->count(),
            'rejectedSummariesCount' => $user->summaries->where('status', 'rejected')->count(),
            'trashedSummariesCount'  => $user->summaries()->onlyTrashed()->where('deleted_by', auth()->id())->count(),
            'savedCount'        => $user->savedSummaries->count(),
            'likesCount'        => $user->likedSummaries->count(),
            'downloadsCount'    => $user->downloads->count(),
        ]);
    }
}