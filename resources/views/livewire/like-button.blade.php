<button wire:click="toggleLike" 
        type="button" 
        class="flex text-xs flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition"
        
        title="إعجاب">
    
<svg
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    class="w-4 h-4 mb-1 {{ $liked ? 'stroke-blue-600 fill-blue-600' : 'stroke-current fill-none' }}"
>
    <path d="M7 10v12"></path>
    <path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"></path>
</svg>
    <span class="text-[9px] font-bold">
        {{ $summary->likers_count ?? $summary->likers()->count() }}
    </span>
</button>