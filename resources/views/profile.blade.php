@extends('layouts.app')

@section('content')
<main class="flex-grow p-4 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">

    <!-- قسم الملف الشخصي -->
    <div class="relative bg-gradient-to-br from-sky-50 via-white to-sky-50 rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100 overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">

            <!-- بيانات المستخدم -->
            <div class="flex items-start gap-4">
                <!-- صورة البروفايل -->
                <div class="relative flex-shrink-0">
                    <img src="{{ $fakeUser['avatar'] ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}"
                         alt="{{ $fakeUser['name'] ?? 'الصورة الشخصية' }}"
                         class="w-16 h-16 rounded-full object-cover ring-4 ring-white shadow-md">
                    <span class="absolute bottom-0 left-0 w-3.5 h-3.5 bg-sky-500 rounded-full ring-2 ring-white" title="نشط الآن"></span>
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-lg font-black text-slate-900">{{$user->name}}</h1>
                        <span class="inline-flex items-center gap-1 bg-sky-100 text-sky-700 text-[10px] font-bold px-2 py-0.5 rounded-full">
                            <i data-lucide="badge-check" class="w-3 h-3"></i>
                            عضو موثق
                        </span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 bg-white text-slate-500 text-[11px] font-semibold px-2.5 py-1 rounded-full border border-slate-200">
                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-sky-500"></i>
                        <span>قسم {{$user->basic_department->name}}</span>
                    </div>
                    <div class="flex items-center gap-3 flex-wrap text-[11px] text-slate-500 font-medium">
                        <span class="flex items-center gap-1">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                            {{$user->email}}
                        </span>
                    </div>
                </div>
            </div>

            <!-- أزرار الإجراءات -->
            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                <a href="#" class="bg-white hover:bg-slate-50 text-slate-700 font-bold py-2 px-4 rounded-xl text-xs border border-slate-200 transition flex items-center gap-2 shadow-sm">
                    <i data-lucide="settings" class="w-4 h-4 text-slate-500"></i>
                    <span>تعديل الملف</span>
                </a>
                <button class="bg-sky-600 hover:bg-sky-500 text-white font-bold py-2 px-4 rounded-xl text-xs transition flex items-center gap-2 shadow-sm">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>رفع ملخص جديد</span>
                </button>
            </div>
        </div>
    </div>

    <!-- إحصائيات سريعة -->
    <div class="flex justify-between flex-wrap gap-4">

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
            <div class="space-y-1">
                <span class="text-2xl font-black text-slate-900 block">{{ $summaries->count() }}</span>
                <span class="text-xs font-bold text-slate-500 block">ملخص مرفوع</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i data-lucide="file-text" class="w-5 h-5"></i>
            </div>
        </div>
        @if($user->id == 1)
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
            <div class="space-y-1">
                <span class="text-2xl font-black text-slate-900 block">{{$savedSummaries->count()}}</span>
                <span class="text-xs font-bold text-slate-500 block">ملخص في مذكرتي</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="bookmark" class="w-5 h-5"></i>
            </div>
        </div>
        @endif
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
            <div class="space-y-1">
                <span class="text-2xl font-black text-slate-900 block">{{ $likedSummaries->count()}}</span>
                <span class="text-xs font-bold text-slate-500 block">إعجاب مكتسب</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i data-lucide="thumbs-up" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
            <div class="space-y-1">
                <span class="text-2xl font-black text-slate-900 block">{{$downloadSummaries->count()}}</span>
                <span class="text-xs font-bold text-slate-500 block">إجمالي التنزيلات</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i data-lucide="download-cloud" class="w-5 h-5"></i>
            </div>
        </div>

        
    </div>

    <!-- شريط البحث -->
    <div class="relative">
        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute top-1/2 -translate-y-1/2 right-4"></i>
        <input type="text" placeholder="ابحث عن الملخصات..."
                    class="w-full bg-white border border-slate-200 rounded-full py-2.5 pr-10 pl-4 text-xs text-slate-600 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow-sm">
    </div>
    <livewire:profile-tabs />
</main>
@endsection
