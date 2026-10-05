<div>
    <!-- بطاقات الإحصائيات السريعة للملخصات -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- البطاقة الأولى: الملخصات المقبولة -->
    <div wire:click="changeTab('uploadedSummaries')"
        class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                transition-all duration-200 ease-out
                hover:shadow-md hover:-translate-y-0.5
                active:scale-[0.97] active:shadow-sm
                {{ $tab === 'uploadedSummaries'
                    ? 'bg-emerald-50 border-emerald-400 ring-2 ring-emerald-400/40 shadow-md'
                    : 'bg-white border-slate-200/80 hover:border-emerald-300' }}">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold {{ $tab === 'uploadedSummaries' ? 'text-emerald-700' : 'text-slate-500' }}">
                الملخصات المقبولة
            </span>
            <div class="w-8 h-8 rounded-xl flex items-center justify-center
                        {{ $tab === 'uploadedSummaries' ? 'bg-emerald-100 text-emerald-700' : 'bg-emerald-50 text-emerald-600' }}">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-2xl font-black text-slate-900">{{ $acceptedCount ?? 0 }}</span>
            <span class="text-[11px] font-semibold text-emerald-600">نشط</span>
        </div>
    </div>

    <!-- البطاقة الثانية: قيد المراجعة -->
    <div wire:click="changeTab('uploadedRequests')"
        class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                transition-all duration-200 ease-out
                hover:shadow-md hover:-translate-y-0.5
                active:scale-[0.97] active:shadow-sm
                {{ $tab === 'uploadedRequests'
                    ? 'bg-amber-50 border-amber-400 ring-2 ring-amber-400/40 shadow-md'
                    : 'bg-white border-slate-200/80 hover:border-amber-300' }}">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold {{ $tab === 'uploadedRequests' ? 'text-amber-700' : 'text-slate-500' }}">
                قيد المراجعة
            </span>
            <div class="w-8 h-8 rounded-xl flex items-center justify-center
                        {{ $tab === 'uploadedRequests' ? 'bg-amber-100 text-amber-700' : 'bg-amber-50 text-amber-600' }}">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-2xl font-black text-slate-900">{{ $pendingCount ?? 0 }}</span>
            <span class="text-[11px] font-semibold text-amber-600">تحتاج موافقة</span>
        </div>
    </div>

    <!-- البطاقة الثالثة: المرفوضة -->
    <div wire:click="changeTab('uploadedRejected')"
        class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                transition-all duration-200 ease-out
                hover:shadow-md hover:-translate-y-0.5
                active:scale-[0.97] active:shadow-sm
                {{ $tab === 'uploadedRejected'
                    ? 'bg-rose-50 border-rose-400 ring-2 ring-rose-400/40 shadow-md'
                    : 'bg-white border-slate-200/80 hover:border-rose-300' }}">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold {{ $tab === 'uploadedRejected' ? 'text-rose-700' : 'text-slate-500' }}">
                الملخصات المرفوضة
            </span>
            <div class="w-8 h-8 rounded-xl flex items-center justify-center
                        {{ $tab === 'uploadedRejected' ? 'bg-rose-100 text-rose-700' : 'bg-rose-50 text-rose-600' }}">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="15" y1="9" x2="9" y2="15" />
                    <line x1="9" y1="9" x2="15" y2="15" />
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-2xl font-black text-slate-900">{{ $rejectedCount ?? 0 }}</span>
            <span class="text-[11px] font-semibold text-rose-600">مستبعدة</span>
        </div>
    </div>

    <!-- البطاقة الرابعة: المحذوفة -->
    <div wire:click="changeTab('deletedSummaries')"
        class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                transition-all duration-200 ease-out
                hover:shadow-md hover:-translate-y-0.5
                active:scale-[0.97] active:shadow-sm
                {{ $tab === 'deletedSummaries'
                    ? 'bg-rose-50 border-rose-400 ring-2 ring-rose-400/40 shadow-md'
                    : 'bg-white border-slate-200/80 hover:border-rose-300' }}">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold {{ $tab === 'deletedSummaries' ? 'text-rose-700' : 'text-slate-500' }}">
                الملخصات المحذوفة
            </span>
            <div class="w-8 h-8 rounded-xl flex items-center justify-center
                        {{ $tab === 'deletedSummaries' ? 'bg-rose-100 text-rose-700' : 'bg-rose-50 text-rose-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-2xl font-black text-slate-900">{{$deletedCount}}</span>
            <span class="text-[11px] font-semibold text-rose-600">محذوف</span>
        </div>
    </div>
</div>

    {{-- ==================== شريط البحث والفلترة ==================== --}}
    <x-search-and-sort-department :departments="$departments" :department="$department" :subjects="$subjects"/>


@if($tab === 'uploadedSummaries' || $tab === 'uploadedRejected' || $tab === 'uploadedRequests' || $tab === 'deletedSummaries')
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
    
        <div class="p-6 pb-0 flex items-center justify-between flex-wrap gap-4">
            <div>
                @if($tab === 'deletedSummaries')
                    <h2 class="text-sm font-black text-slate-900">الملخصات المحذوفة بالمنصة</h2>
                    <p class="text-xs text-slate-500 mt-0.5">عرض الملخصات التي تم حذفها من المنصة مع إمكانية مراجعتها أو استعادتها.</p>          
                @else
                    @if($tab === 'uploadedSummaries')
                        <h2 class="text-sm font-black text-slate-900">الملخصات المرفوعة بالمنصة</h2>
                        <p class="text-xs text-slate-500 mt-0.5">عرض ومتابعة جميع الملخصات المقبولة والمنشورة على المنصة.</p>
                    @elseif($tab === 'uploadedRejected')
                        <h2 class="text-sm font-black text-slate-900">الملخصات المرفوضة بالمنصة</h2>
                        <p class="text-xs text-slate-500 mt-0.5">عرض الملخصات التي تم رفض طلب نشرها لعدم استيفائها معايير المنصة.</p>             
                    @else
                        <h2 class="text-sm font-black text-slate-900">أحدث الملخصات المرفوعة بالمنصة</h2>
                        <p class="text-xs text-slate-500 mt-0.5">مراجعة الملخصات الجديدة وقبولها أو رفضها قبل نشرها على المنصة.</p>
                    @endif
                @endif
                
            </div>

            <span class="text-xs font-bold text-slate-500">
                عدد النتائج: {{ $summaries->total() }}
            </span>
        </div>



        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-y border-slate-200 text-[11px] font-bold text-slate-500">
                        <th class="py-3 pl-2 pr-1 w-6 text-center">#</th>
                        <th class="py-3 px-6">عنوان الملخص</th>
                        <th class="py-3 px-6">الناشر</th>
                        <th class="py-3 px-6">المادة</th>
                        <th class="py-3 px-6">القسم</th>
                        <th class="py-3 px-6">الوقت</th>
                        <th class="py-3 px-3 text-center">الحالة</th>
                        <th class="py-3 px-3 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                    
                    @foreach($summaries as $summary)
                        <tr wire:key="summary-row-{{ $summary->id }}" class="hover:bg-slate-50/60 transition">
                            <td class="py-4 pl-2 pr-1 text-center">
                                <span class="inline-flex items-center gap-0.5 text-[9px] font-bold text-slate-400">
                                    <span>#</span>
                                    <span class="text-slate-500">{{ $loop->iteration + (($summaries->currentPage() - 1) * $summaries->perPage()) }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <a href="{{ route('summaries.show', $summary) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                    {{ $summary->title }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-slate-800 font-semibold">
                                    <a href="{{ route('profile.show', $summary->user->id) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                        {{ $summary->user->name }}
                                    </a>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                <a href="{{ route('subjects.show', $summary->subject->id) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                    {{ $summary->subject->name }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                <a href="{{ route('departments.show', $summary->subject->department->id) }}"
                                    class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                    {{ $summary->subject->department->name ?? 'غير محدد' }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-slate-400">{{ $summary->created_at->diffForHumans() }}</td>
                            <td class="py-4 px-3 text-slate-500">
                                @if($summary->trashed())
                                    <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60">محذوف</span>
                                @else
                                    @if($summary->status === 'accepted')
                                        <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">مقبول ومنشور</span>
                                    @elseif($summary->status === 'rejected')
                                        <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60">مرفوض</span>
                                    @else
                                        <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-200/60">قيد المراجعة</span>
                                    @endif
                                @endif
                            </td>
                            <td class="py-4 px-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    @if($summary->trashed())
                                    <button type="button" 
                                    wire:click="restoreSummary({{$summary->id}})" 
                                    wire:loading.attr="disabled"
                                    class="cursor-pointer p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="استرجاع">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <polyline points="1 4 1 10 7 10"></polyline>
                                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                        </svg>
                                    </button>
                                    @endif
                                    @if($summary->status === 'accepted')
                                    
                                    @elseif($summary->status === 'rejected' && !$summary->trashed())
                                    <button type="button" 
                                    wire:click="returnSummary({{$summary->id}})" 
                                    wire:loading.attr="disabled"
                                    class="cursor-pointer p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="استرجاع لوضع قيد الإنتظار">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <polyline points="1 4 1 10 7 10"></polyline>
                                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                        </svg>
                                    </button>
                                    @elseif($summary->status === 'pending')
                                    <button type="button" 
                                    wire:click="acceptSummary({{$summary->id}})"
                                    wire:loading.attr="disabled"
                                    class="cursor-pointer p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="قبول ونشر">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </button>
                                    <button type="button" 
                                    wire:click="$dispatch('confirmAction', {
                                        component: 'admin.summaries-table',
                                        method: 'rejectSummary',
                                        params: { id: {{ $summary->id }} },
                                        title: 'رفض الملخص',
                                        message: 'هل أنت متأكد من رفض هذا الملخص؟.',
                                        confirmText: 'نعم، رفض',
                                        cancelText: 'إلغاء'
                                    })"
                                    wire:loading.attr="disabled"
                                    class="cursor-pointer p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="رفض">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    
                                    @endif
                                    <button type="button" 
                                    wire:click="$dispatch('confirmAction', {
                                        component: 'admin.summaries-table',
                                        method: 'deleteSummary',
                                        params: { id: {{ $summary->id }} },
                                        title: 'حذف الملخص',
                                        message: 'هل أنت متأكد من حذف هذا الملخص؟.',
                                        confirmText: 'نعم، حذف',
                                        cancelText: 'إلغاء'
                                    })"
                                    wire:loading.attr="disabled"
                                    class="cursor-pointer p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="حذف (محتوى مسيء أو خاطئ)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if ($summaries->total() === 0)
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-400 text-xs font-semibold">
                                لا يوجد ملخصات لعرضهم حالياً
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif


    <!-- نظام التصفح (Pagination) -->
    <x-pagination-department :summaries="$summaries"/>
</div>
