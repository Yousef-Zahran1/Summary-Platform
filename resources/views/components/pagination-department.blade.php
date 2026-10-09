@props(['paginator' => null, 'summaries' => null, 'livewire' => false])

@php
    $pager = $paginator ?? $summaries;
@endphp

@if ($pager && $pager->hasPages())
    <div class="flex items-center justify-center pt-6 border-t border-slate-200">
        <div class="flex items-center gap-1.5 flex-wrap justify-center">

            {{-- السابق --}}
            @if ($pager->onFirstPage())
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            @else
                @if ($livewire)
                    <button type="button" wire:click="previousPage"
                        x-on:click="$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }))"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                @else
                    <a href="{{ $pager->previousPageUrl() }}"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                @endif
            @endif

            {{-- الأرقام --}}
            @foreach ($pager->getUrlRange(1, $pager->lastPage()) as $page => $url)
                @if ($page == $pager->currentPage())
                    <span class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">
                        {{ $page }}
                    </span>
                @else
                    @if ($livewire)
                        <button type="button" wire:click="gotoPage({{ $page }})"
                            x-on:click="$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }))"
                            class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition cursor-pointer">
                            {{ $page }}
                        </button>
                    @else
                        <a href="{{ $url }}"
                            class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition cursor-pointer">
                            {{ $page }}
                        </a>
                    @endif
                @endif
            @endforeach

            {{-- التالي --}}
            @if ($pager->hasMorePages())
                @if ($livewire)
                    <button type="button" wire:click="nextPage"
                        x-on:click="$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }))"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                @else
                    <a href="{{ $pager->nextPageUrl() }}"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </a>
                @endif
            @else
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
            @endif

        </div>
    </div>
@endif