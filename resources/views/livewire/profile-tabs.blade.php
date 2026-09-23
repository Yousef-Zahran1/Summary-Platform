<!-- التبويبات -->
<div class="space-y-5">

    <div class="flex flex-wrap items-center gap-2">
        <button
                wire:click="changeTab('my-summaries')"
                class="px-4 py-2 rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'my-summaries'
                        ? 'bg-sky-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}"
            >
            <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
            <span>ملخصاتي المرفوعة ({{ $userSummariesCount }})</span>
        </button>
        @if(auth()->id() == $user->id)
        <button
                wire:click="changeTab('saved-summaries')"
                class="px-4 py-2 rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'saved-summaries'
                        ? 'bg-sky-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}"
            >
            <i data-lucide="bookmark" class="w-3.5 h-3.5"></i>
            <span>الملخصات المحفوظة ({{ $savedCount }})</span>
        </button>
        @endif

        <button
                wire:click="changeTab('likes')"
                class="px-4 py-2 rounded-full text-xs font-bold transition flex items-center gap-2
                    {{ $tab === 'likes'
                        ? 'bg-sky-600 text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}"
            >
            <i data-lucide="heart" class="w-3.5 h-3.5"></i>
            <span>أعجبني ({{ $likesCount }})</span>
        </button>

    </div>


    <!-- شريط عدد النتائج وخيارات الترتيب فوق الـ Grid (مطابق للـ Home) -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm">
        <div class="text-slate-700 text-xs font-bold">
            @if($summaries->total() > 0)
                <span>عرض {{ $summaries->firstItem() }} إلى {{ $summaries->lastItem() }} من إجمالي {{ $summaries->total() }} ملخص منشور</span>
            @else
                <span>لا توجد ملخصات منشورة حتى الآن</span>
            @endif
        </div>
        

        <x-summaries-filter :route="route('profile.show', $user->id )" />


    </div>
    



    <!-- 1. محتوى تبويب ملخصاتي -->
    @if($tab === 'my-summaries')
        <div class="space-y-4">
            <!-- شبكة البطاقات -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($summaries as $summary)
                    <x-summary-card :summary="$summary"/>
                @empty
                    <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                        لا توجد ملخصات مرفوعة حتى الآن.
                    </div>
                @endforelse
            </div>
        </div>
    @endif






    <!-- 2. محتوى تبويب الملخصات المحفوظة -->
    @if($tab === 'saved-summaries')
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($summaries as $summary)
                    <x-summary-card :summary="$summary"/>
                @empty
                    <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                        لا توجد ملخصات محفوظة.
                    </div>
                @endforelse
            </div>
        </div>
    @endif





    <!-- 3. محتوى تبويب أعجبني -->
    @if($tab === 'likes')
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($summaries as $summary)
                    <x-summary-card :summary="$summary"/>
                @empty
                    <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 text-xs">
                        لم تقم الإعجاب بأي ملخص بعد.
                    </div>
                @endforelse
            </div>
        </div>
    @endif




@if ($summaries->hasPages())
    <div class="flex items-center justify-center pt-6 border-t border-slate-200">
        <div class="flex items-center gap-1.5 flex-wrap justify-center">
            
            @if ($summaries->onFirstPage())
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
            @else
                <a href="{{ $summaries->previousPageUrl()}}" class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            @endif

            @foreach ($summaries->getUrlRange(1, $summaries->lastPage()) as $page => $url)
                @if ($page == $summaries->currentPage())
                    <span class="w-9 h-9 rounded-xl bg-sky-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url}}" class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition">{{ $page }}</a>
                @endif
            @endforeach

            @if ($summaries->hasMorePages())
                <a href="{{ $summaries->nextPageUrl() }}" class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </a>
            @else
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </span>
            @endif

        </div>
    </div>
@endif



</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        // أول ما الصفحة تفتح لأول مرة
        lucide.createIcons();

        // كل ما Livewire يحدث جزء من الصفحة ويخلص (after update)
        Livewire.hook('morph.updated', ({ el, component }) => {
            lucide.createIcons();
        });
    });
</script>