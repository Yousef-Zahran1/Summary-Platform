<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaginationDepartment extends Component
{
    public $paginator;
    public $summaries;
    public $livewire;
    public function __construct($paginator = null, $summaries = null, $livewire = false)
    {
        $this->paginator = $paginator;
        $this->summaries = $summaries;
        $this->livewire = $livewire;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination-department');
    }
}
