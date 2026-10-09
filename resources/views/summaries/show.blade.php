@extends('layouts.app')

@section('content')
    <main class="flex-grow p-6 lg:p-10 space-y-8 max-w-6xl mx-auto w-full text-right" dir="rtl">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 flex-wrap">
            <a href="{{ route('summaries.index') }}" class="hover:text-sky-600 transition">الرئيسية</a>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="{{ route('departments.show', $summary->subject->department->id) }}"
                class="hover:text-sky-600 transition">{{ $summary->subject->department->name }}</a>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="{{ route('subjects.show', $summary->subject->id) }}"
                class="hover:text-sky-600 transition">{{ $summary->subject->name }}</a>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-bold">
                {{ Str::limit($summary->title, 30, '...') }}
            </span>
        </nav>

        {{-- ==================== الكارت الرئيسي ==================== --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 space-y-6 text-right">

            <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6">

                {{-- ========== الجانب الأيمن: الشارات والعنوان والوصف ========== --}}
                <div class="space-y-4 flex-1 min-w-0">

                    {{-- الشارات --}}
                    <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">

                        @if ($summary->trashed())
                            <span
                                class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 px-2.5 py-1 rounded-xl border border-rose-200">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span>محذوف — قيد الاستعادة الإدارية</span>
                            </span>
                        @elseif ($summary->status === 'pending')
                            <span
                                class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-xl border border-amber-200">
                                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                <span>قيد المراجعة — لم يتم اعتماده بعد</span>
                            </span>
                        @elseif ($summary->status === 'rejected')
                            <span
                                class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 px-2.5 py-1 rounded-xl border border-rose-200">
                                <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                                <span>مرفوض — لم يستوفِ معايير المنصة</span>
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-xl border border-emerald-100">
                                <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                                <span>معتمد رسمياً من الإدارة الأكاديمية</span>
                            </span>
                        @endif

                        @if ($summary->file_type)
                            <span
                                class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-700 px-2.5 py-1 rounded-xl border border-sky-100">
                                <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                                <span>{{ strtoupper($summary->file_type) }}</span>
                            </span>
                        @endif
                    </div>

                    {{-- العنوان --}}
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight leading-snug">
                        {{ $summary->title }}
                    </h1>

                    {{-- الوصف --}}
                    @if ($summary->description)
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-3xl">
                            {{ $summary->description }}
                        </p>
                    @endif

                    {{-- معلومات سريعة --}}
                    <div class="flex flex-wrap items-center gap-4 pt-1 text-xs text-slate-500">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>{{ $summary->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="download" class="w-3.5 h-3.5 text-sky-600"></i>
                            <span>{{ $summary->downloads_count ?? 0 }} تنزيل</span>
                        </div>
                        @if ($summary->file_size)
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="hard-drive" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>{{ number_format($summary->file_size / 1024 / 1024, 2) }} ميجابايت</span>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div class="border-t border-slate-100 pt-4 flex sm:flex-row items-center justify-between gap-4 flex-wrap">

                <div class="flex flex-wrap items-center gap-2.5">
                    <div class="flex flex-col gap-3 items-stretch lg:items-end shrink-0 w-full lg:w-auto">

                        @if ($summary->file_path && !$summary->trashed())
                            <a href="{{ route('summaries.download', $summary->id) }}"
                                class="inline-flex items-center justify-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-6 rounded-2xl text-sm shadow-sm hover:shadow-md transition">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                <span>تحميل الملخص</span>
                            </a>
                        @else
                            <button type="button" disabled
                                class="inline-flex items-center justify-center gap-2 bg-slate-100 text-slate-400 font-bold py-3 px-6 rounded-2xl text-sm cursor-not-allowed border border-slate-200">
                                <i data-lucide="file-x" class="w-4 h-4"></i>
                                <span>لا يوجد ملف</span>
                            </button>
                        @endif

                    </div>
                    <livewire:like-button :summary="$summary" variant="button" />
                    <livewire:save-button :summary="$summary" variant="button" />

                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('تم نسخ الرابط بنجاح!');"
                        class="bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold py-2.5 px-4 rounded-2xl text-xs flex items-center gap-2 transition shadow-xs">
                        <span>مشاركة الرابط</span>
                        <i data-lucide="share-2" class="w-4 h-4 text-slate-500"></i>
                    </button>
                </div>

                @if ($summary->user_id == auth()->id() && auth()->user()->role === 'student')
                    <div  class="flex items-center gap-1 font-bold">
                        <button x-data type="button"
                            @click="$dispatch('open-confirm', {
                                action: '{{ route('summaries.destroy', $summary->id) }}',
                                method: 'DELETE',
                                title: 'حذف الملخص',
                                message: 'هل أنت متأكد من حذف هذا الملخص؟',
                                confirmText: 'نعم، احذف',
                                cancelText: 'إلغاء'
                            })"
                            class="flex cursor-pointer flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-red-50 hover:text-red-500 transition"
                            title="حذف"
                        >
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            <span class="text-[9px] font-bold mt-0.5">حذف</span>
                        </button>

                        @if ($summary->status !== 'rejected')
                            <a href="{{ route('summaries.edit', $summary->id) }}"
                                class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition"
                                title="تعديل">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">تعديل</span>
                            </a>
                        @endif
                    </div>
                @endif

                @if ($summary->user_id !== auth()->id() && auth()->user()->role === 'student')
                    <button
                        class="bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-100 font-semibold py-2.5 px-4 rounded-2xl text-xs flex items-center gap-2 transition">
                        <span>الإبلاغ عن خطأ أو تعديل بالمحتوى</span>
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600"></i>
                    </button>
                @endif

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <div class="flex items-center gap-1">
                        @if ($summary->status === 'pending')
                            <button type="button"
                                class="flex cursor-pointer flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:text-emerald-600 hover:bg-emerald-50 transition"
                                title="قبول ونشر">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">قبول</span>
                            </button>
                            <button type="button"
                                class="flex cursor-pointer flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:text-amber-600 hover:bg-amber-50 transition"
                                title="رفض">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">رفض</span>
                            </button>
                        @elseif($summary->status === 'rejected')
                            <button type="button"
                                class="flex cursor-pointer flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:text-emerald-600 hover:bg-emerald-50 transition"
                                title="استرجاع">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                    <polyline points="1 4 1 10 7 10"></polyline>
                                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">استرجاع</span>
                            </button>
                        @endif

                        <button type="button"
                            class="flex cursor-pointer flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-red-50 hover:text-red-500 transition"
                            title="حذف">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            <span class="text-[9px] font-bold mt-0.5">حذف</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-13 gap-6 items-start">

            <div class="lg:col-span-9 space-y-6">

                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 text-right">

                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <i data-lucide="folder-git-2" class="w-4 h-4 text-sky-600"></i>
                            <span class="text-xs font-bold text-slate-900">ملخصات ذات صلة بالمادة</span>
                        </div>
                        <a href="{{ route('subjects.show', $summary->subject->id) }}"
                            class="text-[11px] font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1 transition">
                            <span>عرض الكل</span>
                            <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>

                    @php
                        $related = $summary->subject
                            ->summaries()
                            ->where('status', 'accepted')
                            ->where('id', '!=', $summary->id)
                            ->latest()
                            ->take(3)
                            ->get();
                    @endphp

                    @if ($related->count() > 0)
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            @foreach ($related as $relatedSummary)
                                <x-summary-card :summary="$relatedSummary" :variant="'small'" />
                            @endforeach
                        </div>
                    @else
                        <div class="py-8 text-center text-slate-400 text-xs font-semibold">
                            لا توجد ملخصات أخرى في هذه المادة حتى الآن.
                        </div>
                    @endif

                </div>

            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm space-y-4 text-right">

                    <div class="flex items-center gap-2 pb-2">
                        <i data-lucide="user" class="w-4 h-4 text-slate-700"></i>
                        <span class="text-xs font-black text-slate-900">الطالب المساهم بالملخص</span>
                    </div>

                    <div class="flex items-center gap-3.5">
                        <a href="{{ route('profile.show', $summary->user->id) }}"
                            class="relative w-16 h-16 rounded-full overflow-hidden bg-slate-200 shrink-0 shadow-sm border-2 border-white ring-1 ring-slate-200">
                            @if ($summary->user->avatar)
                                <img src="{{ asset('storage/' . $summary->user->avatar) }}"
                                    alt="{{ $summary->user->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-full h-full text-slate-400 p-2" viewBox="0 0 24 24" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 12.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 2.25c-4.14 0-7.5 2.35-7.5 5.25v.75a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75V20.25c0-2.9-3.36-5.25-7.5-5.25Z" />
                                </svg>
                            @endif
                        </a>

                        <div class="space-y-1 min-w-0">
                            <a href="{{ route('profile.show', $summary->user->id) }}"
                                class="hover:text-sky-800 duration-200 text-sm font-black text-slate-900 block truncate">
                                {{ $summary->user->name }}
                            </a>

                            @if ($summary->user->basic_department ?? null)
                                <span class="text-[11px] font-bold text-slate-500 block">
                                    قسم {{ $summary->user->basic_department->name }}
                                </span>
                            @endif

                            <div class="flex items-center gap-1.5 text-teal-700">
                                <i data-lucide="file-up" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                                <span class="text-[11px] font-bold">
                                    {{ $summary->user->summaries->count() }} مُلَخَّصاً منشوراً
                                </span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.show', $summary->user->id) }}"
                        class="w-full bg-sky-50 hover:bg-sky-100 text-sky-700 font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <i data-lucide="user-search" class="w-4 h-4"></i>
                        <span>استعراض جميع ملخصاته</span>
                    </a>

                </div>

                {{-- بيانات المادة --}}
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 text-right">

                    <div class="flex items-center gap-2 pb-2">
                        <i data-lucide="network" class="w-4 h-4 text-slate-700"></i>
                        <span class="text-xs font-black text-slate-900">بيانات المادة الأكاديمية</span>
                    </div>

                    <div class="space-y-3 text-xs">

                        <div class="flex items-center justify-between bg-slate-50 p-3 rounded-2xl border border-slate-100">
                            <span class="text-slate-500 font-medium">اسم المادة:</span>
                            <span class="font-bold text-slate-900">{{ $summary->subject->name }}</span>
                        </div>

                        <div class="flex items-center justify-between bg-slate-50 p-3 rounded-2xl border border-slate-100">
                            <span class="text-slate-500 font-medium">كود المادة:</span>
                            <span class="font-bold text-slate-900 font-mono">{{ $summary->subject->code }}</span>
                        </div>

                        <div
                            class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
                            <span class="text-slate-500 font-medium">الساعات المعتمدة:</span>
                            <span
                                class="font-bold text-slate-900">{{ $summary->subject->credit_hours ? $summary->subject->credit_hours . ' ساعات معتمدة' : 'غير محدد' }}</span>
                        </div>

                        <div class="flex items-center justify-between bg-slate-50 p-3 rounded-2xl border border-slate-100">
                            <span class="text-slate-500 font-medium">القسم:</span>
                            <a href="{{ route('departments.show', $summary->subject->department->id) }}"
                                class="font-bold text-slate-900 hover:text-sky-600 transition">
                                {{ $summary->subject->department->name }}
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>
@endsection
