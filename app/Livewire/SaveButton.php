<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Summary;

class SaveButton extends Component
{
    public bool $saved;
    public $variant = "icon";
    public Summary $summary;

    public function mount(){
        $this->saved = $this->summary->savers()->where('user_id', auth()->id())->exists();
    }

    public function toggleSave(){
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return;
        }
        $this->summary->savers()->toggle(auth()->id());
        $this->saved= !$this->saved;
        
    }
    public function render()
    {
        return view('livewire.save-button');
    }
}
