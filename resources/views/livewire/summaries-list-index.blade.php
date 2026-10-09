<div id="summaries-grid">
    <!-- شريط الفلتر والترتيب -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm mb-6">
        <div class="text-slate-700 text-xs font-bold">
            @if($summaries->total() > 0)
                <span>عرض {{ $summaries->firstItem() }} إلى {{ $summaries->lastItem() }} من إجمالي {{ $summaries->total() }} ملخص متوفر{{$search ? " حسب نتائج البحث ($search)":"." }}</span>
            @else
                <span>لا توجد ملخصات متاحة{{$search ? " حسب نتائج البحث ($search)":"." }}</span>
            @endif
        </div>

        <div class="relative w-full sm:w-auto">
            <select wire:model.live="sort" 
                    wire:key="sort-select-{{ $sort }}" 
                    class="appearance-none bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-4 py-2.5 pl-10 focus:outline-none focus:border-blue-500 transition font-medium w-full sm:w-44 cursor-pointer">
                <option value="latest">الأحدث</option>
                <option value="oldest">الأقدم</option>
                <option value="highest_likes">الأعلى إعجاباً</option>
                <option value="highest_downloads">الأعلى تنزيلاً</option>
            </select>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 gap-1">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
        </div>
    </div>
.

    <!-- شبكة العرض أو رسالة عدم وجود ملخصات -->
    @if($summaries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach ($summaries as $summary)
                <x-summary-card :summary="$summary"/>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center space-y-3 shadow-sm mb-6">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                    <path d="m6 14 1.5-2.9A2 2 0 0 1 9.3 10H20a2 2 0 0 1 1.94 2.5l-1.5 6a2 2 0 0 1-1.94 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.93a2 2 0 0 1 1.66.9l.82 1.2a2 2 0 0 0 1.66.9H18a2 2 0 0 1 2 2v2"></path>
                </svg>
            </div>
            <h3 class="text-sm font-bold text-slate-800">لا توجد ملخصات مضافة حتى الآن</h3>
            <p class="text-xs text-slate-500 max-w-sm mx-auto">كن أول من يشارك زملائك ملخصات هذا القسم واربح نقاط التميز في المنصة.</p>
        </div>
    @endif

    
    <x-pagination-department :summaries="$summaries" :livewire="true"/>

</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        lucide.createIcons();
        Livewire.hook('morph.updated', ({ el, component }) => {
            lucide.createIcons();
        });
    });
</script>