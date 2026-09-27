<?php

namespace App\Livewire;

use Livewire\Component;

class SearchSummaries extends Component
{
    public $search = '';
    public function updatedSearch(){
        $this->dispatch('search-update' , search: $this->search );
    }
    public function render()
    {
        return view('livewire.search-summaries');
    }
}
