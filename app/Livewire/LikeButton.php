<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Summary;

class LikeButton extends Component
{
    public Summary $summary;
    public bool $liked;

    public function mount()
    {
        $this->liked = $this->summary->likers()->where('user_id', 1)->exists();
    }
    public function toggleLike()
    {
        $this->summary->likers()->toggle(1);
        $this->liked = !$this->liked;
        $this->summary->loadCount('likers');
        // $this->summary->refresh();
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}