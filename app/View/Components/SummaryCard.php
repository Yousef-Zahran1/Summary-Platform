<?php

namespace App\View\Components;

use App\Models\Summary;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SummaryCard extends Component
{
    public function __construct(
        public Summary $summary
    ) {
    }

    public function render(): View
    {
        return view('components.summary-card');
    }
}