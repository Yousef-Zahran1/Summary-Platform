<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Summary;

class LikeButton extends Component
{
    public Summary $summary;
    public bool $liked;
    public $variant = "icon";

    public function mount()
    {
        // $this->liked = auth()->check()  ? $this->summary->likers()->where('user_id', auth()->id())->exists() : false;
        if(auth()->check() && auth()->user()->role === 'student'){
            $this->liked = $this->summary->likers()->where('user_id', auth()->id())->exists();
        }else {
            $this->liked = false;
        }
        
    }
    public function toggleLike()
    {
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return;
        }
        $this->summary->likers()->toggle(auth()->id());
        $this->liked = !$this->liked;
        $this->summary->loadCount('likers');
        // $this->summary->refresh();
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}