<div class="hidden md:flex items-center gap-4 flex-1 max-w-2xl mx-8">
    <div
        class="flex items-center flex-1 bg-slate-50/80 border border-slate-200 rounded-2xl px-4 py-2.5 gap-2.5 shadow-2xs focus-within:border-sky-500 transition"
    >

        <button type="submit" class="shrink-0 cursor-pointer text-slate-400 hover:text-sky-600 transition" title="بحث">
            <i data-lucide="search" class="w-4 h-4"></i>
        </button>

        <input
            type="search"
            wire:model.live.debounce.500ms="search"
            placeholder="ابحث عن ملخص، مذكرة، شيتات، اسم المادة أو كودها..."
            class="w-full bg-transparent text-xs text-slate-800 placeholder-slate-400 focus:outline-none"
        >

    </div>
</div>
