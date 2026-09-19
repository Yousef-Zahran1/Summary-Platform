<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Summary;

class SaveButton extends Component
{
    public bool $saved;
    public Summary $summary;

    public function mount(){
        $this->saved = $this->summary->savers()->where('user_id',1)->exists();
    }

    public function toggleSave(){
        $this->summary->savers()->toggle(1);
        $this->saved= !$this->saved;
        
    }
    public function render()
    {
        return view('livewire.save-button');
    }
}
