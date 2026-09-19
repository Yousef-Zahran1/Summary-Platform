<button wire:click="toggleSave" 
        type="button" 
        class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition"
        title="حفظ الملخص">
    
    
    <!-- شلنا wire:ignore عشان الـ Livewire يقدر يحدث الكلاسات والألوان فوراً -->
    <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
             class="w-4 h-4 mb-1 group-hover/btn:scale-110 transition 
             {{ $saved ? 'stroke-amber-600 fill-amber-600' : 'stroke-current fill-none' }}" 
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
        </svg>
    </span>
    
    <span class="text-[9px] font-bold {{ $saved ? 'text-amber-600' : 'text-slate-500' }}">
        حفظ
    </span>
</button>