@extends('layouts.app')

@section('content')
    <main class="flex-grow p-4 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">

        <div
            class="relative bg-gradient-to-br from-sky-50 via-white to-sky-50 rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100 overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">

                <div class="flex gap-4 items-center">
                    <div
                        class="relative w-30 h-30 rounded-full overflow-hidden bg-gray-200 shrink-0 shadow-sm border-2 border-white ring-1 ring-gray-200">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 12.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 2.25c-4.14 0-7.5 2.35-7.5 5.25v.75a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75V20.25c0-2.9-3.36-5.25-7.5-5.25Z" />
                            </svg>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-lg font-black text-slate-900">{{ $user->name }}</h1>
                            <span
                                class="inline-flex items-center gap-1 bg-sky-100 text-sky-700 text-[10px] font-bold px-2 py-0.5 rounded-full">
                                <i data-lucide="badge-check" class="w-3 h-3"></i>
                                عضو موثق
                            </span>
                        </div>

                        <div class="flex items-center gap-2 flex-wrap">
                            <div
                                class="inline-flex items-center gap-1.5 bg-white text-slate-500 text-[11px] font-semibold px-2.5 py-1 rounded-full border border-slate-200">
                                <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-sky-500"></i>
                                <span>قسم {{ $user->basic_department->name ?? 'غير محدد' }}</span>
                            </div>
                            <span
                                class="flex items-center gap-1 text-[11px] text-slate-500 font-medium bg-white px-2.5 py-1 rounded-full border border-slate-200">
                                <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                                {{ $user->email }}
                            </span>
                        </div>

                        @if ($user->bio)
                            <p class="text-xs text-slate-600 font-normal max-w-xl leading-relaxed pt-1">
                                {{ $user->bio }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                    @if ($user->id == auth()->id())
                        <a href="{{ route('settings') }}"
                            class="bg-white hover:bg-slate-50 text-slate-700 font-bold py-2 px-4 rounded-xl text-xs border border-slate-200 transition flex items-center gap-2 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-slate-500">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            <span>تعديل الملف</span>
                        </a>
                    @else
                        @if (auth()->user()->role === 'admin')
                            <button type="button"
                                class="bg-[#ff7e2841] hover:bg-[#ff7e284d] text-amber-700 border border-amber-200/80 font-bold py-2 px-4 rounded-xl text-xs transition flex items-center gap-2 shadow-2xs cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-amber-600">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                </svg>
                                <span>حظر المستخدم</span>
                            </button>
                        @else
                            <div class="relative group flex items-center gap-4">
                                <span class="bg-amber-100 text-amber-800 text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border border-amber-200">قريباً</span>
                                <button type="button" disabled
                                    class="bg-slate-100 text-slate-400 font-bold py-2 px-5 rounded-xl text-xs flex items-center gap-2 cursor-not-allowed border border-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-slate-400">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" x2="20" y2="14"></line> 
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                    <span>متابعة</span>
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="flex justify-between flex-wrap gap-4">

            <div
                class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
                <div class="space-y-1">
                    <span class="text-2xl font-black text-slate-900 block">{{ $userSummariesCount }}</span>
                    <span class="text-xs font-bold text-slate-500 block">ملخص مرفوع</span>
                </div>
                <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
                <div class="space-y-1">
                    <span class="text-2xl font-black text-slate-900 block">{{ $totalLikes }}</span>
                    <span class="text-xs font-bold text-slate-500 block">إعجاب مكتسب</span>
                </div>
                <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i data-lucide="thumbs-up" class="w-5 h-5"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
                <div class="space-y-1">
                    <span class="text-2xl font-black text-slate-900 block">{{ $downloadsCount }}</span>
                    <span class="text-xs font-bold text-slate-500 block">إجمالي التنزيلات</span>
                </div>
                <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i data-lucide="download-cloud" class="w-5 h-5"></i>
                </div>
            </div>

        </div>

        <livewire:profile-tabs :user='$user' />
    </main>
@endsection
