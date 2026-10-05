<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Summary;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class SummariesListIndex extends Component
{
    use WithPagination;
    #[Url(history: true)]
    public $sort = 'latest'; 

    #[Url(except: 1)]
    public $page = 1;

    
    public $search = '';

    public $departmentId = null;
    public $subjectId = null;
    public $userId = null;


    public function updatedSort()
    {
        $this->resetPage();
    }

    #[On('search-update')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    public function render()
    {
        $query = Summary::with(['subject' , 'user' , 'subject.department'])->withCount(['downloads', 'likers'])->where('status' , 'accepted');

        $search = $this->search;;
        if ($search) {
            $query->where(function ($query) use ($search){
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('subject', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('subject.department', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });
        }


        if($this->departmentId){
            $query->wherehas('subject' , function($q) {
                $q->where('department_id', $this->departmentId);
            });
        }
        if($this->subjectId){
            $query->where('subject_id', $this->subjectId);
        }
        if($this->userId){
            $query->where('user_id', $this->userId);
        }


        $sort = $this->sort;
        if($sort === "latest"){
            $query->latest();
        } 
        elseif($sort === "oldest"){
            $query->oldest();
        } 
        elseif($sort === "highest_likes"){
            $query->orderByDesc('likers_count');
        } 
        elseif($sort === "highest_downloads"){
            $query->orderByDesc('downloads_count');
        }


        $summaries = $query->paginate(15)->withQueryString();
        return view('livewire.summaries-list-index' , compact('summaries'));
        
    }
}