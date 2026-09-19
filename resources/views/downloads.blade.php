@extends('layouts.app')
@section("content")
    <!-- محتوى صفحة المحفوظات -->
    <main class="flex-grow p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">
        <div  class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm">
            <div class="text-slate-700 text-xs font-bold">
                @if($summaries->total() > 0)
                    <span>عرض {{ $summaries->firstItem() }} إلى {{ $summaries->lastItem() }} من إجمالي {{ $summaries->total() }} ملخص تم تنزيله</span>
                @else
                    <span>لا توجد ملخصات منشورة حتى الآن</span>
                @endif
            </div>
            <form method="GET" action="{{route('downloads.index')}}" class="relative w-full sm:w-auto">
                <select name="sort" onchange="this.form.submit()" class="appearance-none bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-4 py-2.5 
                                pl-10 focus:outline-none focus:border-blue-500 transition font-medium w-full sm:w-44 cursor-pointer">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>الأحدث</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم</option>
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 gap-1">
                    <!-- أيقونة Chevron Down -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                
                </div>
            </form>
        </div>
        <!-- 4. محتوى تبويب سجل التنزيلات -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-sm font-black text-slate-800">سجل التنزيلات الأخيرة</h3>
                    <p class="text-xs text-slate-500 mt-0.5">تابع الملفات والمذكرات التي قم بتحميلها مع توقيت التنزيل.</p>
                </div>
                <button class="text-xs text-rose-600 hover:text-rose-700 font-bold flex items-center gap-1.5 self-start sm:self-auto bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-xl transition">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    <span>إفريغ السجل</span>
                </button>
            </div>

            <div>
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-500">
                            <th class="py-3 px-6">المادة / اسم الملخص</th>
                            <th class="py-3 px-6">القسم الدراسي</th>
                            <th class="py-3 px-6">توقيت التنزيل</th>
                            <th class="py-3 px-6">الحجم</th>
                            <th class="py-3 px-6 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                        @foreach($summaries as $summary)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-3.5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="file-text" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <a href="#" class="font-bold text-slate-900 hover:text-blue-600 transition block">{{$summary->title}}</a>
                                            <span class="text-[10px] text-slate-400">بواسطة: {{$summary->user->name}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-semibold">
                                        {{$summary->subject->department->name}}
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-slate-500 text-[11px]">
                                    <!-- تم تصحيح تركيب الـ Span داخل الأيقونة هنا لتجنب مشاكل التصميم -->
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                                        <span>{{$summary->pivot->created_at->diffForHumans()}}</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-6 text-slate-500 text-[11px]">
                                    4.2 ميجابايت
                                </td>
                                <td class="py-3.5 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="#" title="تحميل مرة أخرى" class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition flex items-center justify-center">
                                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                        </a>
                                        <a href="{{route('summaries.show' , $summary->id )}}" title="عرض الملخص" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition flex items-center justify-center">
                                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            <x-summaries-pagination :summaries="$summaries"/>

    </main>
@endsection('content')