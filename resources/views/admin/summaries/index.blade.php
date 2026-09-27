@extends('layouts.app')

@section('content')
<main class="flex-grow p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">
        
    <x-messages />

    <!-- بطاقات الإحصائيات السريعة للملخصات -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- البطاقة الأولى: إجمالي الملخصات -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">إجمالي الملخصات</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $summaries->total() ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-blue-600">ملخص بالمنصة</span>
            </div>
        </div>

        <!-- البطاقة الثانية: المقبولة والمنشورة -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">الملخصات المقبولة</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $acceptedCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-emerald-600">نشط</span>
            </div>
        </div>

        <!-- البطاقة الثالثة: قيد المراجعة -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">قيد المراجعة</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $pendingCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-amber-600">تحتاج موافقة</span>
            </div>
        </div>

        <!-- البطاقة الرابعة: المرفوضة / المخالفة -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">الملخصات المرفوضة</span>
                <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $rejectedCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-rose-600">مستبعدة</span>
            </div>
        </div>

    </div>

{{-- ==================== شريط البحث والفلترة ==================== --}}
        <div class="">
            <form method="GET" action="" class="bg-white border border-slate-200/80 rounded-2xl p-4 space-y-3">
                <div class="flex flex-wrap gap-3 items-end">

                    
                    {{-- فلترة حسب القسم --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">القسم الدراسي</label>
                        <select name="department" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="">كل الأقسام</option>
                            @foreach(($departments ?? collect()) as $dept)
                                <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                            {{-- بيانات وهمية للعرض فقط --}}
                            @if(!isset($departments))
                                <option value="1">علوم الحاسب</option>
                                <option value="2">نظم المعلومات</option>
                                <option value="3">هندسة البرمجيات</option>
                                <option value="4">الأمن السيبراني</option>
                            @endif
                        </select>
                    </div>

                    {{-- فلترة حسب المستوى --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">المستوى الدراسي</label>
                        <select name="level" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="">كل المستويات</option>
                            <option value="1" {{ request('level') == 1 ? 'selected' : '' }}>المستوى الأول</option>
                            <option value="2" {{ request('level') == 2 ? 'selected' : '' }}>المستوى الثاني</option>
                            <option value="3" {{ request('level') == 3 ? 'selected' : '' }}>المستوى الثالث</option>
                            <option value="4" {{ request('level') == 4 ? 'selected' : '' }}>المستوى الرابع</option>
                        </select>
                    </div>

                    {{-- الترتيب حسب الوقت --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">الترتيب</label>
                        <select name="sort" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث أولاً</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم أولاً</option>
                        </select>
                    </div>

                </div>

            </form>
        </div>

        <div class="relative mb-5">
            <i data-lucide="search" class="w-4 h-4  text-slate-400 absolute top-1/2 -translate-y-1/2 right-4"></i>
            <input type="search"  placeholder="ابحث عن مستخدم..."
                class="w-full bg-white border border-slate-200 rounded-full py-2.5 pr-10 pl-4 text-xs text-slate-600 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow-sm">
        </div>

    <!-- الجزء السفلي: جدول إدارة الملخصات بالمنصة -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        <div class="p-6 pb-0 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-sm font-black text-slate-900">إدارة ومراجعة الملخصات</h2>
                <p class="text-xs text-slate-500 mt-0.5">مراجعة الملخصات المرفوعة حديثاً، قبولها للنشر، أو حذف المحتوى المخالف.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-y border-slate-200 text-[11px] font-bold text-slate-500">
                        <th class="py-3 pl-2 pr-1 w-6 text-center">#</th>
                        <th class="py-3 px-6">عنوان الملخص</th>
                        <th class="py-3 px-6">الناشر</th>
                        <th class="py-3 px-6">المادة الدراسية</th>
                        <th class="py-3 px-6">قسم المادة</th>
                        <th class="py-3 px-6">وقت الرفع</th>
                        <th class="py-3 px-6 text-center">الإجراءات الإدارية</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                    
                    @foreach($summaries as $summary)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-4 pl-2 pr-1 text-center">
                                <span class="inline-flex items-center gap-0.5 text-[9px] font-bold text-slate-400">
                                    <span>#</span>
                                    <span class="text-slate-500">{{ $loop->iteration + (($summaries->currentPage() - 1) * $summaries->perPage()) }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-900 max-w-xs truncate">
                              <a href="{{ route('summaries.show', $summary) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900 font-medium">
                                {{ $summary->title }}
                              </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-slate-800 font-semibold">
                                    <a href="{{ route('profile.show', $summary->user->id) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                        {{ $summary->user->name ?? 'مستخدم مجهول' }}
                                    </a>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                              <a href="{{ route('subjects.show', $summary->subject->id) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                {{ $summary->subject->name ?? 'غير محدد' }}
                              </a>
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                              <a href="{{ route('departments.show', $summary->subject->department->id) }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900">
                                {{ $summary->subject->department->name ?? 'غير محدد' }}
                              </a>
                            </td>
                            <td class="py-4 px-6 text-slate-400">{{ $summary->created_at->diffForHumans() }}</td>
                            
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    


                                    <!-- زر الحذف النهائي -->
                                    <form action="#" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الملخص نهائياً؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer" title="حذف نهائي (محتوى مخالف)">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        
    </div>

    <!-- نظام التصفح (Pagination) -->
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