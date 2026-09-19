<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة يوسف زهران</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    },
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts: Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8fafc; color: #0f172a; }
    </style>
    <!-- Alpine.js (تم تصحيح الرابط هنا ليعمل بسلاسة) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen flex antialiased selection:bg-sky-600 selection:text-white">

    <!-- القائمة الجانبية بالوضع الفاتح -->
    <aside class="w-72 bg-white border-l border-slate-200 hidden lg:flex flex-col justify-between sticky top-0 h-screen z-30 p-6 shadow-sm">
        <div class="space-y-8">
            <!-- الشعار -->
             <div class="flex items-center gap-3 shrink-0">
                <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-200 flex items-center justify-center text-sky-800 font-bold text-xs shadow-xs overflow-hidden shrink-0">
                    <!-- أيقونة التخرج SVG -->
                    <svg class="w-5 h-5 text-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.038L12.83 5.18a2 2 0 0 0-1.66 0L2.59 9.884a1 1 0 0 0 0 1.732l8.58 4.704a2 2 0 0 0 1.66 0l8.58-4.704a1 1 0 0 0 .01-.004Z"/>
                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                    </svg>
                </div>
                <div class="text-right">
                    <span class="text-xs font-black text-slate-900 block">كلية العلوم جامعة المنوفية</span>
                    <span class="text-[10px] text-slate-500 font-medium block">بوابة الملخصات والمحاضرات والإمتحانات السابقة</span>
                </div>
            </div>

            <!-- روابط التصفح -->
            <div class="space-y-1.5 pt-2">
                <span class="text-[10px] font-black text-slate-400 tracking-widest block uppercase px-3 mb-2">القائمة الرئيسية</span>
                
                <a href="{{route('summaries.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('summaries.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
                    <!-- أيقونة الرئيسية SVG -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <span>الصفحة الرئيسية</span>
                </a>

                <a href="{{route('profile.show')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('profile.show') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
                    <!-- أيقونة الملف الشخصي SVG -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="5"/>
                        <path d="M20 21a8 8 0 0 0-16 0"/>
                    </svg>
                    <span>الملف الشخصي</span>
                </a>

                <a href="{{route('downloads.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('downloads.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
                    <!-- أيقونة التنزيلات SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                        <path d="M3 3v5h5"></path>
                        <path d="M12 7v5l4 2"></path>
                    </svg>
                    <span>سجل التنزيلات</span>
                </a>

                <a href="{{route('settings.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('settings.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
                    <!-- أيقونة الإعدادات SVG -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 21v-7"/>
                        <path d="M4 10V3"/>
                        <path d="M12 21v-9"/>
                        <path d="M12 8V3"/>
                        <path d="M20 21v-5"/>
                        <path d="M20 12V3"/>
                        <path d="M1 14h6"/>
                        <path d="M9 8h6"/>
                        <path d="M17 16h6"/>
                    </svg>
                    <span>الإعدادات</span>
                </a>
            </div>
        </div>

        <!-- معلومات المستخدم المصغرة في الأسفل -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-sky-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">
                    ي
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-slate-900 block truncate">يوسف زهران</span>
                    <span class="text-[10px] text-slate-500 block truncate">علوم الحاسب</span>
                </div>
            </div>
            <a href="#" class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition" title="خروج">
                <!-- أيقونة الخروج SVG -->
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" x2="9" y1="12" y2="12"/>
                </svg>
            </a>
        </div>
    </aside>

    <!-- المحتوى الرئيسي -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
        
        <!-- الشريط العلوي المعدل -->
        <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200 px-6 lg:px-10 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            
            <!-- المنتصف: شريط البحث -->
            <div class="hidden md:flex items-center gap-4 flex-1 max-w-2xl mx-8">
                <div class="flex items-center flex-1 bg-slate-50/80 border border-slate-200 rounded-2xl px-4 py-2.5 gap-2.5 shadow-2xs focus-within:border-sky-500 transition">
                    <!-- أيقونة البحث SVG -->
                    <svg class="w-4 h-4 text-slate-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="text" placeholder="ابحث عن ملخص، مذكرة، شيتات، اسم المادة أو كودها..." class="w-full bg-transparent text-xs text-slate-800 placeholder-slate-400 focus:outline-none">
                </div>
            </div>
            
            <!-- الجهة اليسار: الإشعارات وبطاقة المستخدم -->
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{route('summaries.create')}}" class="cursor-pointer bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center gap-2 shadow-sm shadow-sky-600/20 transition shrink-0">
                    <!-- أيقونة رفع ملف SVG -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <path d="M12 12v6"/>
                        <path d="m15 15-3-3-3 3"/>
                    </svg>
                    <span>رفع ملخص جديد</span>
                </a>

                <!-- زر الإشعارات -->
                <button class="p-2.5 text-slate-600 hover:text-sky-600 hover:bg-slate-100 rounded-2xl transition relative">
                    <!-- أيقونة الجرس SVG -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                    </svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-rose-600 rounded-full"></span>
                </button>

                <!-- بطاقة المستخدم المطورة -->
                <div class="flex items-center gap-3 py-1.5 rounded-2xl cursor-pointer transition border border-transparent">
                    <div class="relative w-9 h-9 rounded-full shrink-0 shadow-xs border border-sky-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=120&q=80" class="w-full h-full object-cover" alt="صورة المستخدم">
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-sky-500 border-2 border-white rounded-full"></span>
                    </div>
                </div>
            </div>

        </header>

        @yield('content')
        
    </div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
</body>
</html>