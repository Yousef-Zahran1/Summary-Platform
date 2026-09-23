@extends('layouts.app')

@section('content')
<main class="flex-grow p-4 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">
    
    <!-- قسم الملف الشخصي -->
    <div class="relative bg-gradient-to-br from-sky-50 via-white to-sky-50 rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100 overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">

            <!-- بيانات المستخدم -->
            <div class="flex gap-4 items-center ">
                <!-- صورة البروفايل -->
                <div class="relative w-30 h-30 rounded-full overflow-hidden bg-gray-200 shrink-0 shadow-sm border-2 border-white ring-1 ring-gray-200">
                        @if($user->avatar)
                            <img 
                                src="{{ asset('storage/' . $user->avatar) }}" 
                                alt="{{ $user->name }}" 
                                class="w-full h-full object-cover"
                            >
                        @else
                            {{-- أيقونة الشخص الافتراضية بستايل فيسبوك --}}
                            <svg 
                                class="w-full h-full text-white" 
                                viewBox="0 0 24 24" 
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M12 12.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 2.25c-4.14 0-7.5 2.35-7.5 5.25v.75a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75V20.25c0-2.9-3.36-5.25-7.5-5.25Z"/>
                            </svg>
                        @endif
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
                        <span>قسم {{$user->basic_department->name ?? 'غير محدد'}}</span>
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
            <div  class="flex items-center gap-2 w-full md:w-auto justify-end">
                @if($user->id == auth()->id())
                    <!-- أزرار خاصة بصاحب البروفايل -->
                    <a href="{{ route('settings') }}" class="bg-white hover:bg-slate-50 text-slate-700 font-bold py-2 px-4 rounded-xl text-xs border border-slate-200 transition flex items-center gap-2 shadow-sm">
                        <i data-lucide="settings" class="w-4 h-4 text-slate-500"></i>
                        <span>تعديل الملف</span>
                    </a>
                    <a href="{{ route('summaries.create') }}" class="bg-sky-600 hover:bg-sky-500 text-white font-bold py-2 px-4 rounded-xl text-xs transition flex items-center gap-2 shadow-sm">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        <span>رفع ملخص جديد</span>
                    </a>
                @else
                    <!-- أزرار تظهر للزوار فقط -->
                    <button class="bg-sky-600 hover:bg-sky-500 text-white font-bold py-2 px-5 rounded-xl text-xs transition flex items-center gap-2 shadow-sm">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>متابعة</span>
                    </button>
                    <!-- <button class="bg-white hover:bg-slate-50 text-slate-700 font-bold py-2 px-4 rounded-xl text-xs border border-slate-200 transition flex items-center gap-2 shadow-sm">
                        <i data-lucide="message-square" class="w-4 h-4 text-slate-500"></i>
                        <span>مراسلة</span>
                    </button> -->
                @endif
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
        <!-- @if($user->id == auth()->id())
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
            <div class="space-y-1">
                <span class="text-2xl font-black text-slate-900 block">{{$savedSummaries->count()}}</span>
                <span class="text-xs font-bold text-slate-500 block">ملخص في مذكرتي</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="bookmark" class="w-5 h-5"></i>
            </div>
        </div>
        @endif -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between flex-1 min-w-56">
            <div class="space-y-1">
                <span class="text-2xl font-black text-slate-900 block">{{ $totalLikes }}</span>
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
    <livewire:profile-tabs :user='$user'/>
</main>
@endsection
