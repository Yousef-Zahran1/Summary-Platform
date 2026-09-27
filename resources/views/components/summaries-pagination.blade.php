@props(['summaries'])

@if ($summaries->hasPages())
    <div class="flex items-center justify-center pt-6 border-t border-slate-200">
        <div class="flex items-center gap-1.5 flex-wrap justify-center">
            
            {{-- زر الصفحة السابقة --}}
            @if ($summaries->onFirstPage())
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
            @else
                <button type="button" 
                        wire:click="previousPage" 
                        wire:loading.attr="disabled"
                        wire:loading.remove.attr="disabled"
    x-on:click="$nextTick(() => document.getElementById('summaries-grid').scrollIntoView({ behavior: 'smooth' }))"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            @endif

            @foreach ($summaries->getUrlRange(1, $summaries->lastPage()) as $page => $url)
                @if ($page == $summaries->currentPage())
                    <span class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">{{ $page }}</span>
                @else
                    <button type="button" 
                            wire:click="gotoPage({{ $page }})" 
                            wire:loading.attr="disabled"
                            wire:loading.remove.attr="disabled"
    x-on:click="$nextTick(() => document.getElementById('summaries-grid').scrollIntoView({ behavior: 'smooth' }))"
                            class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition cursor-pointer">
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            @if ($summaries->hasMorePages())
                <button type="button" 
                        wire:click="nextPage" 
                        wire:loading.attr="disabled"
                        wire:loading.remove.attr="disabled"
    x-on:click="$nextTick(() => document.getElementById('summaries-grid').scrollIntoView({ behavior: 'smooth' }))"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
            @else
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </span>
            @endif

        </div>
    </div>
@endif