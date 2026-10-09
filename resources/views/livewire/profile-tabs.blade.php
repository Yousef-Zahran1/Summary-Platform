@props([
    'summary',
    'variant' => 'normal',
    'isPending' => false,
    'isTrashed' => false,
    'isRejected' => false,   
])
<div>
    <div class="relative mb-5">
        <i data-lucide="search" class="w-4 h-4  text-slate-400 absolute top-1/2 -translate-y-1/2 right-4"></i>
        <input type="search" wire:model.live.depounce.300ms="search" placeholder="ابحث عن الملخصات..."
            class="w-full bg-white border border-slate-200 rounded-full py-2.5 pr-10 pl-4 text-xs text-slate-600 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow-sm">
    </div>
    <div id="summaries-grid" class="space-y-5">

        <div class="flex flex-wrap items-center gap-2">

            <button wire:click="changeTab('my-summaries')"
                class="px-4 py-2 cursor-pointer rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'my-summaries'
                        ? 'bg-sky-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
                <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                <span>{{ auth()->id() == $user->id ? 'ملخصاتي المرفوعة' : 'ملخصاته المرفوعة' }}
                    ({{ $userSummariesCount }})</span>
            </button>

            @if (auth()->id() == $user->id)

                <button wire:click="changeTab('pending-summaries')"
                    class="px-4 py-2 cursor-pointer rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'pending-summaries'
                        ? 'bg-sky-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
                    <i data-lucide="bookmark" class="w-3.5 h-3.5"></i>
                    <span> الملخصات قيد المراجعة ({{ $pendingSummariesCount }})</span>
                </button>

            @endif

                <button wire:click="changeTab('likes')"
                    class="px-4 py-2 cursor-pointer rounded-full text-xs font-bold transition flex items-center gap-2
                        {{ $tab === 'likes'
                            ? 'bg-sky-600 text-white shadow-sm'
                            : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                    <span>{{ auth()->id() == $user->id ? 'ملخصات اعجبتني' : 'ملخصات اعجب بها' }}
                        ({{ $likesCount }})</span>
                </button>

            @if (auth()->id() == $user->id)
            
                <button wire:click="changeTab('saved-summaries')"
                    class="px-4 py-2 cursor-pointer rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'saved-summaries'
                        ? 'bg-sky-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
                    <i data-lucide="bookmark" class="w-3.5 h-3.5"></i>
                    <span>الملخصات المحفوظة ({{ $savedCount }})</span>
                </button>

                <button wire:click="changeTab('rejected-summaries')"
                    class="px-4 py-2 cursor-pointer rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'rejected-summaries'
                        ? 'bg-orange-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
                    <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                    <span>الملخصات المرفوضة ({{ $rejectedSummariesCount }})</span>
                </button>

                <button wire:click="changeTab('trashed-summaries')"
                    class="px-4 py-2 cursor-pointer rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'trashed-summaries'
                        ? 'bg-rose-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    <span>الملخصات المحذوفة ({{ $trashedSummariesCount }})</span>
                </button>

            @endif


        </div>


        <!-- شريط عدد النتائج وخيارات الترتيب فوق الـ Grid (مطابق للـ Home) -->
        <div
            class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm">
            <div class="text-slate-700 text-xs font-bold">
                @if ($summaries->total() > 0)
                    <span>عرض {{ $summaries->firstItem() }} إلى {{ $summaries->lastItem() }} من إجمالي
                        {{ $summaries->total() }} ملخص منشور {{ $search ? " حسب نتائج البحث ($search)" : '.' }}</span>
                @else
                    <span>لا توجد ملخصات متاحة{{ $search ? " حسب نتائج البحث ($search)" : '.' }}</span>
                @endif
            </div>


            <div class="relative w-full sm:w-auto">
                <select wire:model.live="sort" wire:key="sort-select-{{ $sort }}"
                    class="appearance-none bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-4 py-2.5 
                            pl-10 focus:outline-none focus:border-blue-500 transition font-medium w-full sm:w-44 cursor-pointer">
                    <option value="latest">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                    <option value="highest_likes">الأعلى إعجاباً</option>
                    <option value="highest_downloads">الأعلى تنزيلاً</option>
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 gap-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </div>


        </div>



        @if ($tab === 'my-summaries' || $tab === 'saved-summaries' || $tab === 'likes' )
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($summaries as $summary)
                        <x-summary-card :summary="$summary" />
                    @empty
                        <div
                            class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                            لا توجد ملخصات.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif


        @if ($tab === 'pending-summaries')
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($summaries as $summary)
                        <x-summary-card :summary="$summary" :isPending=true/>
                    @empty
                        <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                            لم تقم الإعجاب بأي ملخص بعد.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        @if ($tab === 'trashed-summaries')
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($summaries as $summary)
                        <x-summary-card :summary="$summary" :isTrashed="true" />
                    @empty
                        <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                            لا توجد ملخصات محذوفة.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        @if ($tab === 'rejected-summaries')
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($summaries as $summary)
                        <x-summary-card :summary="$summary" :isRejected="true" />
                    @empty
                        <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                            لا توجد ملخصات مرفوضة.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        <x-pagination-department :summaries="$summaries" :livewire="true"/>



    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        lucide.createIcons();

        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            lucide.createIcons();
        });
    });
</script>
