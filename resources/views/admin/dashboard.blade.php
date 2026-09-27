@extends('layouts.app')

@section('content')
<main class="flex-grow p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">
            
    <x-messages />


    <!-- بطاقات الإحصائيات السريعة -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- البطاقة الأولى -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">الملخصات المرفوعة</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $totalSummaries ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-emerald-600">ملخص نشط</span>
            </div>
        </div>


        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">الحسابات النشطة</span>
                <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $totalUsers ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-slate-400">حسابات نشطة</span>
            </div>
        </div>

        <!-- البطاقة الثانية -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">إجمالي التحميلات</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $totalDownloads ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-slate-400">عملية تحميل</span>
            </div>
        </div>

        <!-- البطاقة الثالثة -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">طلبات الرفع</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-0-5H20"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $totalRequests ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-slate-400">مواد الترم الحالي</span>
            </div>
        </div>

        

    </div>

    <!-- الجزء السفلي: جدول أحدث الملخصات المضافة (لوحة تحكم المشرف) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        <div class="p-6 pb-0 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-sm font-black text-slate-900">أحدث الملخصات المضافة بالمنصة</h2>
                <p class="text-xs text-slate-500 mt-0.5">مراجعة، قبول، أو حذف الملخصات المخالفة أو المسيئة.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-y border-slate-200 text-[11px] font-bold text-slate-500">
                        <th class="py-3 px-6">عنوان الملخص</th>
                        <th class="py-3 px-6">الناشر</th>
                        <th class="py-3 px-6">المادة</th>
                        <th class="py-3 px-6">الوقت</th>
                        <th class="py-3 px-6">الحالة</th>
                        <th class="py-3 px-6 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                    
                    @foreach($summaries as $summary)
                        <tr class="hover:bg-slate-50/60 transition">
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
                            <td class="py-4 px-6 text-slate-400">{{ $summary->created_at->diffForHumans() }}</td>
                            <td class="py-4 px-6 text-slate-500">
                                @if($summary->status === 'accepted')
                                    <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">مقبول ومنشور</span>
                                @elseif($summary->status === 'rejected')
                                    <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60">مرفوض</span>
                                @else
                                    <span class="inline-flex items-center px-1.5 py-1 rounded-md text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-200/60">قيد المراجعة</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    @unless(true)
                                        <a href="#" class="p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="قبول ونشر">
                                            <i data-lucide="check" class="w-4 h-4"></i>
                                        </a>
                                        <a href="#" class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="رفض">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </a>
                                    @endunless
                                    <a href="{{ route('summaries.show', $summary) }}" class="p-1.5 text-slate-500 hover:text-sky-600 hover:bg-sky-50 rounded-lg transition" title="مشاهدة">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                    <a href="#" class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="حذف (محتوى مسيء أو خاطئ)">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        
    </div>
    @if ($summaries->hasPages())
    <div class="flex items-center justify-center pt-6 border-t border-slate-200">
        <div class="flex items-center gap-1.5 flex-wrap justify-center">
            
            {{-- زر الصفحة السابقة --}}
            @if ($summaries->onFirstPage())
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
            @else
                <a href="{{ $summaries->previousPageUrl() }}" 
                   class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            @endif

            {{-- أرقام الصفحات --}}
            @foreach ($summaries->getUrlRange(1, $summaries->lastPage()) as $page => $url)
                @if ($page == $summaries->currentPage())
                    <span class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" 
                       class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition cursor-pointer">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- زر الصفحة التالية --}}
            @if ($summaries->hasMorePages())
                <a href="{{ $summaries->nextPageUrl() }}" 
                   class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
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

</main>
@endsection