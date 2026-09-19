@extends('layouts.app')

@section('content')
<main class="flex-grow p-6 lg:p-10 space-y-8 max-w-7xl mx-auto w-full text-right" dir="rtl">
    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
        <a href="{{ route('summaries.index') }}" class="hover:text-blue-600 transition">الرئيسية</a>
        <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
        <a href="#" class="hover:text-blue-600 transition">{{$summary->subject->department->name}}</a>
        <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
        <a href="#" class="hover:text-blue-600 transition">{{$summary->subject->name}}</a>
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
      <div class="flex flex-col gap-5 items-center">
        <div class="flex items-center gap-1 text-slate-500 text-[12px]">
                 <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                 <span class="text-[12px]">{{ $summary->created_at->diffForHumans() }}</span>
             </div>
             <div class="flex text-sm items-center gap-1 text-slate-600 bg-slate-50 px-3 py-1 rounded-xl border border-slate-200">
                       <i data-lucide="download" class="w-3 h-3 text-blue-600"></i>
                       <span class="text-[12px]">{{ $summary->downloads_count ?? 0 }} تنزيل</span>
                   </div>
</div>
        
    </div>

    <!-- خط فاصل خفيف -->
    <div class="border-t border-slate-100 pt-4 flex sm:flex-row items-center justify-between gap-4">
        
        

          
          <!-- الجانب الأيمن: زر التحميل الرئيسي، حفظ، إعجاب، ومشاركة -->
          <div class="flex flex-wrap items-center gap-2.5">
              
              <!-- 1. زر التحميل الرئيسي -->
              <a href="{{ $summary->file_path ?? '#' }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-2xl text-xs flex items-center gap-2 shadow-sm transition">
                  <i data-lucide="download" class="w-4 h-4"></i>
                  <span>تحميل الملف الآن - PDF عالي الدقة ({{ $summary->file_size ?? '6.4 MB' }})</span>
              </a>
      
             <button class="bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-bold py-2 px-3 rounded-xl text-xs flex items-center gap-1.5 transition shadow-xs">
                          <span>142</span>
                          <i data-lucide="thumbs-up" class="w-3.5 h-3.5 text-blue-600"></i>
                      </button>
      
                      <button class="bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold py-2 px-3 rounded-xl text-xs flex items-center gap-1.5 transition shadow-xs">
                          <span>85</span>
                          <i data-lucide="bookmark" class="w-3.5 h-3.5 text-slate-500"></i>
                      </button>
             
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
                        <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                        <span>معاينة الملف والمصفحة الأولى</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-blue-50 text-blue-700 font-bold px-2.5 py-1 rounded-lg border border-blue-100 text-[10px]">النسخة الأولى / تدقيق</span>
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
                    <a href="{{ $summary->file_path ?? '#' }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs flex items-center gap-2 shadow-sm transition shrink-0">
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
            <i data-lucide="folder-git-2" class="w-4 h-4 text-blue-600"></i>
            <span class="text-xs font-bold text-slate-900">ملخصات ذات صلة بالمادة</span>
        </div>
        <a href="#" class="text-[11px] font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition">
            <span>عرض الكل</span>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
        </a>
    </div>

    <!-- قائمة الملخصات ذات الصلة -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        
        <!-- الملخص الأول -->
        <a href="#" class="p-3.5 rounded-2xl border border-slate-100 hover:border-blue-300 bg-slate-50/60 hover:bg-blue-50/20 space-y-2 transition group">
            <div class="flex items-center justify-between">
                <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-0.5 rounded-md">PDF</span>
                <span class="text-[10px] text-slate-400">18 صفحة</span>
            </div>
            <h4 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 line-clamp-1">حلول شيتات العملي (C++ Lab)</h4>
            <div class="flex items-center justify-between text-[10px] text-slate-500 pt-1 border-t border-slate-100/80">
                <span>أحمد كمال</span>
                <span class="text-emerald-600 font-bold">موصى به</span>
            </div>
        </a>

        <!-- الملخص الثاني -->
        <a href="#" class="p-3.5 rounded-2xl border border-slate-100 hover:border-blue-300 bg-slate-50/60 hover:bg-blue-50/20 space-y-2 transition group">
            <div class="flex items-center justify-between">
                <span class="bg-purple-100 text-purple-800 text-[10px] font-bold px-2 py-0.5 rounded-md">PDF</span>
                <span class="text-[10px] text-slate-400">8 صفحات</span>
            </div>
            <h4 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 line-clamp-1">كراسة القوانين والرسوم للتفاضل</h4>
            <div class="flex items-center justify-between text-[10px] text-slate-500 pt-1 border-t border-slate-100/80">
                <span>يوسف أحمد</span>
                <span class="text-emerald-600 font-bold">الأكثر مبيعاً</span>
            </div>
        </a>

        <!-- الملخص الثالث -->
        <a href="#" class="p-3.5 rounded-2xl border border-slate-100 hover:border-blue-300 bg-slate-50/60 hover:bg-blue-50/20 space-y-2 transition group">
            <div class="flex items-center justify-between">
                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded-md">مراجعة</span>
                <span class="text-[10px] text-slate-400">42 صفحة</span>
            </div>
            <h4 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 line-clamp-1">تجميعة امتحانات سابقة محلولة</h4>
            <div class="flex items-center justify-between text-[10px] text-slate-500 pt-1 border-t border-slate-100/80">
                <span>فريق الأوائل</span>
                <span class="text-emerald-600 font-bold">شامل</span>
            </div>
        </a>

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
        <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center shrink-0 overflow-hidden border border-slate-200 shadow-sm">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80" alt="يوسف أحمد" class="w-full h-full object-cover">
        </div>

        <!-- معلومات الناشر (على اليسار) -->
        <div class="space-y-0.5">
            <!-- الاسم -->
            <span class="text-[15px] font-black text-slate-900 block">
                يوسف أحمد
            </span>
            <!-- القسم -->
            <span class="text-[11px] font-bold text-slate-600 block">
                قسم الرياضيات وعلوم الحاسب
            </span>
            <!-- عدد الملخصات -->
            <div class="flex items-center gap-1.5 text-teal-700 pt-1">
                <i data-lucide="file-up" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                <span class="text-[11px] font-bold">24 ملخصاً منشوراً</span>
            </div>
        </div>
    </div>

    <!-- زر استعراض جميع الملخصات -->
    <a href="#" class="w-full bg-[#EEF2FF] hover:bg-[#E0E7FF] text-[#3730A3] font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-2 transition">
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
        
        <!-- كود المادة الدراسي -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">كود المادة الدراسي:</span>
            <span class="font-bold text-slate-900">{{ $summary->subject->code ?? 'CS201' }}</span>
        </div>

        <!-- عدد الساعات المعتمدة -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">عدد الساعات المعتمدة:</span>
            <span class="font-bold text-slate-900">3 ساعات معتمدة (Credit Hours)</span>
        </div>

        <!-- القسم الأكاديمي المسؤول -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">القسم الأكاديمي المسؤول:</span>
            <span class="font-bold text-slate-900">{{ $summary->subject->department->name ?? 'قسم الرياضيات وعلوم الحاسب' }}</span>
        </div>

        <!-- متطلب سابق (Prerequisite) -->
        <div class="flex items-center justify-between bg-slate-50/80 hover:bg-slate-100/60 p-3 rounded-2xl border border-slate-100 transition">
            <span class="text-slate-500 font-medium">متطلب سابق (Prerequisite):</span>
            <span class="font-bold text-slate-900">CS102 (برمجة هيكلية)</span>
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
                        <span class="text-xs font-black text-blue-600 flex items-center justify-center gap-1">
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