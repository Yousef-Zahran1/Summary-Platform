<div>
    @if ($variant === 'button')
        <!-- الشكل الثاني: زرار الإعجاب العريض بالعداد -->
        <button wire:click="toggleLike" type="button"
            class="bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold py-2 px-3 rounded-xl text-xs flex items-center gap-1.5 transition shadow-xs cursor-pointer">

            <span>{{ $summary->likers_count ?? $summary->likers()->count() }}</span>

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="w-3.5 h-3.5 {{ $liked ? 'text-blue-600 fill-blue-600' : 'text-slate-500' }}">
                <path d="M7 10v12"></path>
                <path
                    d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z">
                </path>
            </svg>
        </button>
    @else
        <!-- الشكل الأول (الافتراضي): الأيقونة العمودية الصغيرة -->
        @auth
            <button wire:click="toggleLike" type="button"
                class="flex text-xs flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition cursor-pointer group/like"
                title="إعجاب">

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 mb-1 group-hover/like:scale-110 transition {{ $liked ? 'stroke-blue-600 fill-blue-600' : 'stroke-current fill-none' }}">
                        <path d="M7 10v12"></path>
                        <path
                            d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z">
                        </path>
                    </svg>
                </span>

                <span class="text-[9px] font-bold {{ $liked ? 'text-blue-600' : 'text-slate-500' }}">
                    {{ $summary->likers_count ?? $summary->likers()->count() }}
                </span>
            </button>
        @endauth
        @guest
            <a href="{{ route('login') }}"
                class="flex text-xs flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition cursor-pointer group/like"
                title="إعجاب">

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 mb-1 group-hover/like:scale-110 transition ">
                        <path d="M7 10v12"></path>
                        <path
                            d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z">
                        </path>
                    </svg>
                </span>

                <span class="text-[9px] font-bold {{ $liked ? 'text-blue-600' : 'text-slate-500' }}">
                    {{ $summary->likers_count ?? $summary->likers()->count() }}
                </span>
            </a>
        @endguest
    @endif
</div>
