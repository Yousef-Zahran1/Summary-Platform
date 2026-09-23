@extends('layouts.app')

@section('content')
<main class="flex-grow p-6 lg:p-10 space-y-8 max-w-7xl mx-auto w-full text-right" dir="rtl">
    <x-messages />
    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
        <a href="{{ route('summaries.index') }}" class="hover:text-sky-600 transition">الرئيسية</a>
        <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
        <a href="{{route('departments.show' , $summary->subject->department->id )}}" class="hover:text-sky-600 transition">{{$summary->subject->department->name}}</a>
        <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
        <a href="{{route('subjects.show' , $summary->subject->id )}}" class="hover:text-sky-600 transition">{{$summary->subject->name}}</a>
        <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
        <span class="text-slate-900 font-bold">
    {{ Str::limit($summary->title, 16, '...') }}
</span>
    </nav>

<!-- قسم رأس الملف العلوي -->
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 space-y-6 text-right" dir="rtl">
    
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        
        <!-- الجانب الأيمن: الشارات، العنوان، والوصف -->
        <div class="space-y-3 flex-1">
            <!-- الشارات العلوية -->
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">
                
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-xl border border-emerald-100">
                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                    <span>معتمد رسمياً من الإدارة الأكاديمية</span>
                </span>
            </div>

            <!-- العنوان الرئيسي -->
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight leading-snug">
                {{ $summary->title }}
            </h1>

            <!-- الوصف المختصر -->
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-4xl">
                {{ $summary->description}}
            </p>
        </div>
        <div class="flex flex-col gap-4 items-center justify-center shrink-0">

            <div class="flex flex-col gap-5 items-center">
                <div class="flex items-center gap-1 text-slate-500 text-[12px]">
                    <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                    <span class="text-[12px]">{{ $summary->created_at->diffForHumans() }}</span>
                </div>
                <div class="flex text-sm items-center gap-1 text-slate-600 bg-slate-50 px-3 py-1 rounded-xl border border-slate-200">
                    <i data-lucide="download" class="w-3 h-3 text-sky-600"></i>
                    <span class="text-[12px]">{{ $summary->downloads_count ?? 0 }} تنزيل</span>
                </div>
            </div>
            @if($summary->user_id == auth()->id())
                <div class="flex items-center gap-1 font-bold ">
                    <form action="{{ route('summaries.destroy', $summary->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الملخص؟')" class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-red-50 hover:text-red-500 transition" title="حذف">
                            <!-- أيقونة Trash-2 -->
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            <span class="text-[9px] font-bold mt-0.5">حذف</span>
                        </button>
                    </form>
                    <a href="{{route('summaries.edit' , $summary->id)}}" class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition" title="تعديل">
                        <!-- أيقونة Edit-3 -->
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        <span class="text-[9px] font-bold mt-0.5">تعديل</span>
                    </a>
                </div>
            @endif    
        </div>
    </div>

    <!-- خط فاصل خفيف -->
    <div class="border-t border-slate-100 pt-4 flex sm:flex-row items-center justify-between gap-4">
        
        

          
          <!-- الجانب الأيمن: زر التحميل الرئيسي، حفظ، إعجاب، ومشاركة -->
          <div class="flex flex-wrap items-center gap-2.5">
              
              <!-- 1. زر التحميل الرئيسي -->
              <a href="{{ $summary->file_path ?? '#' }}" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-5 rounded-2xl text-xs flex items-center gap-2 shadow-sm transition">
                  <i data-lucide="download" class="w-4 h-4"></i>
                  <span>تحميل الملف الآن - PDF عالي الدقة ({{ $summary->file_size ?? '6.4 MB' }})</span>
              </a>
      
                    <livewire:like-button :summary="$summary" variant="button" />

                    <livewire:save-button :summary="$summary" variant="button" />
            
            <!-- 4. زر مشاركة الرابط -->
            <button onclick="navigator.clipboard.writeText(window.location.href); alert('تم نسخ الرابط بنجاح!');" class="bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold py-2.5 px-4 rounded-2xl text-xs flex items-center gap-2 transition shadow-xs">
                <span>مشاركة الرابط</span>
                <i data-lucide="share-2" class="w-4 h-4 text-slate-500"></i>
            </button>
    
        </div>
    
        <!-- الجانب الأيسر: زر الإبلاغ عن خطأ أو تعديل بالمحتوى -->
            <button class="bg-rose-50  hover:bg-rose-100 text-rose-700 border border-rose-100 font-semibold py-2.5 px-4 rounded-2xl text-xs flex items-center gap-2 transition">
                <span>الإبلاغ عن خطأ أو تعديل بالمحتوى</span>
                <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600"></i>
            </button>
    
    </div>
<!-- شريط الأزرار والتفاعلات السفلي -->
</div>
    <!-- شبكة المحتوى الرئيسية (قسمين: جانبي ومحتوى رئيسي) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- العمود الأيمن (الجانبي): بيانات المقرر، المواصفات، الناشر، ومقررات أخرى -->
        

        <!-- العمود الأيسر (الرئيسي): عارض PDF المصغر والصورة المطلوبة بداخله -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- كارت العارض الرئيسي -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden space-y-4 p-4 sm:p-6">
                
                <!-- شريط أداة معاينة الملف -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 text-xs">
                    <div class="flex items-center gap-2 font-bold text-slate-700">
                        <i data-lucide="eye" class="w-4 h-4 text-sky-600"></i>
                        <span>معاينة الملف والمصفحة الأولى</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-sky-50 text-sky-700 font-bold px-2.5 py-1 rounded-lg border border-sky-100 text-[10px]">النسخة الأولى / تدقيق</span>
                        <span class="bg-slate-100 text-slate-600 font-medium px-2.5 py-1 rounded-lg text-[10px]">نسخة أصلية Vector عالية الوضوح</span>
                    </div>
                </div>

                <!-- مساحة العرض (تحتوي على الصورة مصغرة ومصممة لتشبه عارض صفحات PDF) -->
                <div class="relative bg-slate-100 rounded-2xl border border-slate-200 p-4 sm:p-6 flex flex-col items-center justify-center overflow-hidden">
                    
                    <!-- رقم الصفحة الحالي -->
                    <div class="absolute top-4 left-4 bg-slate-900/70 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-lg z-10">
                        الصفحة 1 من 36
                    </div>

                    <!-- الصورة المعروضة (نفس صورتك الحالية ولكن بحجم مصغر ومناسب كعارض صفحات) -->
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden max-w-xl w-full">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80" alt="PDF Page Preview" class="w-full h-80 sm:h-96 object-cover object-top opacity-95">
                    </div>

                </div>

                <!-- زر التحميل الأسفل -->
                <div class="pt-2 flex items-center justify-between bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold text-slate-800 block">معاينة موثقة للصفحة الكاملة (36 صفحة)</span>
                        <span class="text-[10px] text-slate-500 block">يتضمن الشرح الكامل وحلول الامتحانات والمسائل الرسمية.</span>
                    </div>
                    <a href="{{ $summary->file_path ?? '#' }}" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs flex items-center gap-2 shadow-sm transition shrink-0">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        <span>تحميل كامل الملف (36 صفحة)</span>
                    </a>
                </div>

            </div>

            <!-- ملخصات ذات صلة بالمادة -->
<div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 text-right" dir="rtl">
    
    <!-- رأس القسم -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2">
            <i data-lucide="folder-git-2" class="w-4 h-4 text-sky-600"></i>
            <span class="text-xs font-bold text-slate-900">ملخصات ذات صلة بالمادة</span>
        </div>
        <a href="{{ route('subjects.show' , $summary->subject->id) }}" class="text-[11px] font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1 transition">
            <span>عرض الكل</span>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
        </a>
    </div>

    <!-- قائمة الملخصات ذات الصلة -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <!-- عرض اول 3 ملخصات فقط  -->
            @php 
                $count = 0; 
            @endphp

            @foreach($summary->subject->summaries as $relatedSummary)
                @if($relatedSummary->id !== $summary->id && $count < 3)
                    <x-summary-card :summary="$relatedSummary" :variant="'small'"/>
                    @php $count++; @endphp
                @endif
            @endforeach

    </div>

</div>

        </div>
        <div class="lg:col-span-4 space-y-6">
            <!-- 3. الطالب المساعد بالمحتوى (الناشر) - بيانات افتراضية -->
<div class="bg-white p-5 rounded-[1.5rem] border border-slate-100 shadow-sm space-y-4 text-right" dir="rtl">
    <div class="flex items-center justify-start gap-2 pb-2">
        <i data-lucide="user" class="w-4 h-4 text-slate-700"></i>
        <span class="text-xs font-black text-slate-900">الطالب المساهم بالملخص</span>
    </div>
    <div class="flex items-center gap-3.5">
        <!-- الصورة الشخصية (على اليمين) -->
        <a href="{{route('profile.show', $summary->user->id)}}" class="relative w-20 h-20 rounded-full overflow-hidden bg-gray-200 shrink-0 shadow-sm border-2 border-white ring-1 ring-gray-200">
            @if($summary->user->avatar)
                <img 
                    src="{{ asset('storage/' . $summary->user->avatar) }}" 
                    alt="{{ $summary->user->name }}" 
                    class="w-full h-full object-cover"
                >
            @else
                <svg 
                    class="w-full h-full text-white" 
                    viewBox="0 0 24 24" 
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path d="M12 12.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 2.25c-4.14 0-7.5 2.35-7.5 5.25v.75a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75V20.25c0-2.9-3.36-5.25-7.5-5.25Z"/>
                </svg>
            @endif
        </a>

        <!-- معلومات الناشر (على اليسار) -->
        <div class="space-y-0.5">
            <!-- الاسم -->
            <a href="{{route('profile.show', $summary->user->id)}}" class="hover:text-sky-800 duration-200 text-[15px] font-black text-slate-900 block">
                {{ $summary->user->name }}
            </a>
            <!-- القسم -->
            <span class="text-[11px] font-bold text-slate-600 block">
                قسم {{ $summary->user->basic_department->name ?? 'غير محدد' }}
            </span>
            <!-- عدد الملخصات -->
            <div class="flex items-center gap-1.5 text-teal-700 pt-1">
                <i data-lucide="file-up" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                <span class="text-[11px] font-bold">{{ $summary->user->summaries->count() }} مُلَخَّصاً منشوراً</span>
            </div>
        </div>
    </div>

    <!-- زر استعراض جميع الملخصات -->
    <a href="{{ route('profile.show', $summary->user->id) }}" class="w-full bg-[#eef9ff] hover:bg-[#e0f3ff] text-[#307fa3] font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-2 transition">
        <i data-lucide="user-search" class="w-4 h-4"></i>
        <span>استعراض جميع ملخصات يوسف</span>
    </a>

</div>
           <!-- بيانات المادة الأكاديمية -->
<div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 text-right" dir="rtl">
    
    <!-- عنوان الكارت والأيقونة -->
    <div class="flex items-center justify-start gap-2 pb-2">
        <i data-lucide="network" class="w-4 h-4 text-slate-700"></i>
        <span class="text-xs font-black text-slate-900">بيانات المادة الأكاديمية</span>
    </div>
    
    <div class="space-y-3 text-xs">
        <!-- اسم المادة -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">اسم المادة:</span>
            <span class="font-bold text-slate-900">{{ $summary->subject->name }}</span>
        </div>
        <!-- كود المادة الدراسي -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">كود المادة الدراسي:</span>
            <span class="font-bold text-slate-900">{{ $summary->subject->code }}</span>
        </div>

        <!-- عدد الساعات المعتمدة -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">عدد الساعات المعتمدة:</span>
            <span class="font-bold text-slate-900">{{ $summary->subject->credit_hours ? $summary->subject->credit_hours . ' ساعات معتمدة (Credit Hours)' : 'غير محدد' }}</span>
        </div>

        <!-- القسم الأكاديمي المسؤول -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">القسم الأكاديمي المسؤول:</span>
            <span class="font-bold text-slate-900">{{ $summary->subject->department->name }}</span>
        </div>

        



    </div>

</div>
            <!-- 2. المواصفات الفنية للملف -->
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-900 flex items-center gap-2">
                        <i data-lucide="file-check" class="w-4 h-4 text-indigo-600"></i>
                        المواصفات الفنية للملف
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-3 text-center">
                    <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100 space-y-1">
                        <span class="text-[10px] text-slate-400 block">حجم الملف</span>
                        <span class="text-xs font-black text-slate-800">6.4 MB</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100 space-y-1">
                        <span class="text-[10px] text-slate-400 block">صيغة الملف</span>
                        <span class="text-xs font-black text-sky-600 flex items-center justify-center gap-1">
                            <i data-lucide="file-text" class="w-3.5 h-3.5"></i> PDF (Vector HQ)
                        </span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100 space-y-1 col-span-2">
                        <span class="text-[10px] text-slate-400 block">عدد الصفحات</span>
                        <span class="text-xs font-black text-slate-800">36 صفحة كاملة</span>
                    </div>
                </div>

                <div class="bg-emerald-50/50 p-3 rounded-2xl border border-emerald-100 flex  items-center gap-2.5">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                        <span class="text-[9px] text-emerald-700 block">الملف مفحوص تماما ومحمي من الفيروسات او العلامات المائية المزعجة </span>
                    
                </div>
            </div>

            


        </div>

    </div>

</main>
@endsection