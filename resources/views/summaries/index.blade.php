@extends('layouts.app')

@section('content')
    <!-- محتوى الصفحة الرئيسية -->
    <main class="flex-grow p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">


        <div class="space-y-6">
            <div
                class="relative bg-gradient-to-r to-sky-700 via-sky-600 from-[#19b2ee] rounded-3xl p-6 lg:p-10 text-white shadow-xl overflow-hidden">
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none">
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">

                    <div class="space-y-4 text-right max-w-2xl">
                        <div
                            class="inline-flex items-center gap-2 bg-white/15 text-white text-xs font-semibold px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/20">
                            <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                            <span>كلية العلوم - جامعة المنوفية | المستودع الطلابي المعتمد</span>
                        </div>

                        <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">
                            منصة ملخصات ومذكرات كلية العلوم - جامعة المنوفية
                        </h1>

                        <p class="text-sky-100 text-xs sm:text-sm leading-relaxed font-medium">
                            مكتبة طلابية تشاركية لمشاركة وتحميل ملخصات، مذكرات، شيتات مقررات الساعات المعتمدة. تصفح وحمل
                            ملخصات أي مادة دراسية مباشرة بدون قيود الفرق الدراسية أو الفصول.
                        </p>

                        <div class="flex flex-wrap items-center gap-4 pt-2 text-[11px] font-semibold text-sky-100">
                            <span
                                class="inline-flex items-center gap-1.5 bg-black/10 px-3 py-1.5 rounded-xl border border-white/10">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-sky-300"></i> مراجعة وتدقيق مع الأوائل
                                والمعيدين
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 bg-black/10 px-3 py-1.5 rounded-xl border border-white/10">
                                <i data-lucide="zap" class="w-3.5 h-3.5 text-sky-300"></i> تحميل فوري مجاني بصيغة PDF عالية
                                الدقة
                            </span>
                        </div>
                    </div>

                    <div
                        class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 text-center lg:text-right w-full lg:w-80 shrink-0 space-y-4 shadow-lg">
                        <div class="flex items-center justify-center lg:justify-start gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-amber-300 shrink-0">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <div>

                                <span class="text-xs font-black block text-white">ساهم بملخصك واربح نقاط التميز</span>
                                <span class="text-[10px] text-sky-200 block">شارك زملائك دراستك المميزة</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-sky-100 leading-relaxed">
                            شارك زملاؤك ملخصاتك الدراسية المتميزة واحصل على شارة ناشر موثق وشهادة تقدير الكلية.
                        </p>
                        @if (!auth()->check() || auth()->user()->role !== 'admin')
                            <a href="{{ route('summaries.create') }}"
                                class="w-full bg-white hover:bg-sky-50 text-sky-700 font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-md">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                <span>رفع ملخص جديد الآن</span>
                            </a>
                        @else
                            <a href="#"
                                class="w-full bg-white hover:bg-sky-50 text-sky-700 font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-md">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                <span>رفع ملخص جديد الآن</span>
                            </a>
                        @endif
                    </div>

                </div>
            </div>

            <!-- كروت الإحصائيات الأربعة -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-2xl lg:text-3xl font-black text-sky-600 block">+{{$allSummaries}}</span>
                        <span class="text-xs font-bold text-slate-700 block">ملف PDF</span>
                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                            <i data-lucide="check-circle-2" class="w-3 h-3 text-sky-600"></i> ملخصات ومذكرات معتمدة
                        </span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 shrink-0">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-2xl lg:text-3xl font-black text-slate-900 block">+{{ $subjectsCount }}</span>
                        <span class="text-xs font-bold text-slate-700 block">مقرر من لائحة الكلية</span>
                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                            <i data-lucide="layers" class="w-3 h-3 text-sky-600"></i> شاملة لكافة التخصصات
                        </span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 shrink-0">
                        <i data-lucide="book" class="w-6 h-6"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-2xl lg:text-3xl font-black text-amber-600 block">+{{ $downloadsCount }}</span>
                        <span class="text-xs font-bold text-slate-700 block">تحميل نشط</span>
                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                            <i data-lucide="trending-up" class="w-3 h-3 text-amber-500"></i> بمشاركة {{$studentCount}} طالب وطالبة
                        </span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 shrink-0">
                        <i data-lucide="cloud-download" class="w-6 h-6"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-2xl lg:text-3xl font-black text-slate-900 block">{{ $departmentsCount }}</span>
                        <span class="text-xs font-bold text-slate-700 block">برنامج تخصصي</span>
                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                            <i data-lucide="git-branch" class="w-3 h-3 text-sky-600"></i> حاسب، كيمياء، فيزياء، بيولوجي
                        </span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 shrink-0">
                        <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                    </div>
                </div>

            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm space-y-4" id="filter-container">

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-900 flex items-center gap-2">
                        <i data-lucide="grid" class="w-4 h-4 text-sky-600"></i>
                        اختر القسم الأكاديمي لتصفح مواده:
                    </span>
                    <span class="text-[10px] text-slate-400">إجمالي الأقسام: {{ $departments->count() }}</span>
                </div>

                <div class="flex flex-wrap gap-3.5">
                    <button
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-sky-600 bg-sky-600 text-white text-xs font-bold transition shadow-xs hover:bg-sky-700">
                        <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                        <span>كافة الأقسام</span>
                    </button>

                    @foreach ($departments as $department)
                        <a href='{{ route('departments.show', $department->id) }}'
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:border-sky-600 hover:bg-sky-50/50 text-slate-700 text-xs font-semibold transition shadow-xs group">
                            <span class="w-2 h-2 rounded-full bg-slate-300 group-hover:bg-sky-600 transition"></span>
                            <span
                                class="text-slate-900 group-hover:text-sky-600 transition truncate max-w-[150px]">{{ $department->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>


        </div>



        <livewire:summaries-list-index />




    </main>
@endsection
