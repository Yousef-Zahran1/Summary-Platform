<?php

namespace App\View\Components;

use App\Models\Summary;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SummaryCard extends Component
{
    public $variant;

    public function __construct(public Summary $summary, $variant = "default") {
        $this->variant = $variant; // التصحيح هنا
    }

    public function render(): View
    {
        return view('components.summary-card');
    }
}