@extends('layouts.app')

@section('content')
        <!-- محتوى صفحة تفاصيل المادة -->
        <main class="flex-grow p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full" dir="rtl" id="summaries-section">
            
            <!-- قسم رأس الصفحة (بانر المادة) -->
            <div class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 rounded-3xl p-6 lg:p-8 text-white shadow-xl overflow-hidden">
                <!-- تأثيرات جمالية في الخلفية -->
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-2 text-right">
                        <!-- مسار التنقل (Breadcrumbs) مصغر داخل البانر -->
                        <nav class="flex items-center gap-2 text-xs text-blue-200 font-medium">
                            <a href="#" class="hover:text-white transition">الرئيسية</a>
                            <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                            @if(isset($subject->department))
                                <a href="{{ route('departments.show', $subject->department->id) }}" class="hover:text-white transition">{{ $subject->department->name }}</a>
                                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                            @endif
                            <span class="text-white font-bold">{{ $subject->name }}</span>
                        </nav>

                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight leading-tight">
                            مقررات وملخصات مادة {{ $subject->name }}
                        </h1>
                        <p class="text-blue-100 text-xs sm:text-sm max-w-xl">
                            تصفح كافة المذكرات والملازم والشيتات الخاصة بمادة {{ $subject->name }} المعتمدة لطلاب كلية العلوم.
                        </p>
                    </div>

                    <!-- زر العودة للأقسام الرئيسية -->
                    @if(isset($subject->department))
                        <a href="{{ route('departments.show', $subject->department->id) }}" class="bg-white/10 hover:bg-white/20 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center gap-2 backdrop-blur-md border border-white/20 transition shadow-sm shrink-0">
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            <span>العوده لمواد قسم {{ $subject->department->name }}</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- شبكة البطاقات (الملخصات المتاحة) -->
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm">
                   <!-- عدد النتائج في الجهة اليمنى -->
                    <div class="text-slate-700 text-xs font-bold">
                        @if($summaries->total() > 0)
                            <span>عرض {{ $summaries->firstItem() }} إلى {{ $summaries->lastItem() }} من إجمالي {{ $summaries->total() }} ملخص منشور</span>
                        @else
                            <span>لا توجد ملخصات منشورة حتى الآن</span>
                        @endif
                    </div>

                    <x-summaries-filter :route="route('subjects.show', $subject->id)"/>
                </div>

                @if($summaries->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($summaries as $summary)
                            <x-summary-card :summary="$summary"/>
                        @endforeach
                    </div>
                @else
                    <!-- حالة عدم وجود ملخصات -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center space-y-3 shadow-sm">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto">
                            <i data-lucide="folder-open" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">لا توجد ملخصات مضافة لهذه المادة حتى الآن</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">كن أول من يشارك زملائك ملخصات هذه المادة واربح نقاط التميز في المنصة.</p>
                    </div>
                @endif
            </div>

            <x-summaries-pagination :summaries="$summaries"/>

        </main>
@endsection