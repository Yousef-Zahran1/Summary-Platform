<div>
    @if($variant === 'button')
        <!-- الشكل الثاني: زرار عريض بـ Border وعداد -->
        <button wire:click="toggleSave" 
                type="button" 
                class=" {{$saved ? 'bg-[#ff9e0c34] hover:bg-[#ff9e0c1c]' : 'bg-slate-50 hover:bg-slate-100'}}  text-slate-700 border border-slate-200 font-semibold py-2 px-3 rounded-xl text-xs flex items-center gap-1.5 transition shadow-xs cursor-pointer">
        
            
            <!-- الأيقونة -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                    class="w-4.2 h-4.5 {{ $saved ? 'text-amber-600 fill-amber-600' : 'text-slate-500' }}" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
            </svg>
        </button>

    @else
        @auth
        <button wire:click="toggleSave" 
                type="button" 
                class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition cursor-pointer group/btn"
                title="حفظ الملخص">
            
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                        class="w-4 h-4 mb-1 group-hover/btn:scale-110 transition {{ $saved ? 'stroke-amber-600 fill-amber-600' : 'stroke-current fill-none' }}" 
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                </svg>
            </span>
            
            <span class="text-[9px] font-bold {{ $saved ? 'text-amber-600' : 'text-slate-500' }}">
                حفظ
            </span>
        </button>
        @endauth
        @guest
        <a href="{{route('login')}}"
                type="button" 
                class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition cursor-pointer group/btn"
                title="حفظ الملخص">
            
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                        class="w-4 h-4 mb-1 group-hover/btn:scale-110 transition {{ $saved ? 'stroke-amber-600 fill-amber-600' : 'stroke-current fill-none' }}" 
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                </svg>
            </span>
            
            <span class="text-[9px] font-bold {{ $saved ? 'text-amber-600' : 'text-slate-500' }}">
                حفظ
            </span>
        </a>
        @endguest
    @endif
</div>