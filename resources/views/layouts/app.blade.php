<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Alpine.js CDN -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Google Fonts: Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8fafc; color: #0f172a; }
    </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="min-h-screen flex antialiased selection:bg-sky-600 selection:text-white">
    @livewire('confirm-action')
    @livewire('messages')

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
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <a href="{{route('admin.summaries.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('admin.summaries.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>التحكم فى الملخصات</span>
                    </a>
                    <a href="{{route('admin.users.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('admin.users.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">                   
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>التحكم فى المستخدمين</span>
                    </a>
                    <a href="{{route('admin.subjects.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('admin.subjects.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">                   
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"></path>
                        </svg>
                        <span>التحكم فى المواد</span>
                    </a>
                    <a href="{{route('admin.departments.index')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('admin.departments.index') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">                   
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span>التحكم فى الأقسام</span>
                    </a>
                    
                @endif
                @if(!auth()->check() || auth()->user()->role !== 'admin')
                    <a href="{{auth()->check() ? route('profile.show', auth()->id()) : route('login') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('profile.show') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
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
                @endif
                <a href="{{route('settings')}}" class="flex items-center gap-3 px-3.5 py-3 rounded-2xl {{ request()->routeIs('settings') ? 'bg-sky-50 text-sky-600 font-bold text-xs border border-sky-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold'}} text-xs transition">
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

        @auth
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <a href="{{route('profile.show', auth()->id() )}}" class="relative w-8 h-8 rounded-full overflow-hidden bg-gray-200 shrink-0 shadow-sm  ring-gray-200">
                            @if(auth()->user()->avatar)
                                <img 
                                    src="{{ asset('storage/' . auth()->user()->avatar ) }}" 
                                    alt="{{ auth()->user()->name  }}" 
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
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{route('profile.show', auth()->id())}}" class="overflow-hidden">
                                <span class="text-xs font-bold text-slate-900 block truncate">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-slate-500 block truncate">{{ Auth::user()->basic_department->name ?? 'قسم غير معروف' }}</span>
                            </a>
                            @else 
                            <div>
                                <span class="text-xs font-bold text-slate-900 block truncate">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-slate-500 block truncate">مسؤول</span>
                            </div>
                        @endif
                    </div>
                    <!-- فورم تسجيل الخروج (يُفضل استخدام فورم لـ Laravel Post) أو رابط مباشر حسب رغبتك -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition cursor-pointer" title="خروج">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <polyline points="16 17 21 12 16 7"/>
                                <line x1="21" x2="9" y1="12" y2="12"/>
                            </svg>
                        </button>
                    </form>
                </div>
        @endauth
        @guest
        <div class="pt-4 border-t border-slate-100 space-y-3">
            <!-- كلام تعريفي عن المنصة شبيه بجيميني -->
            <div class="px-1">
                <p class="text-xs font-semibold text-slate-800">سجل الدخول للمتابعة</p>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">احفظ ملخصاتك، تابع موادك الدراسية، وشارك المحتوى بكل سهولة.</p>
            </div>
            
            <!-- أزرار الدخول وإنشاء الحساب -->
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs transition">
                    <svg class="w-3.5 h-3.5 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" x2="3" y1="12" y2="12"/>
                    </svg>
                    <span>دخول</span>
                </a>
                
            </div>
        </div>
@endguest
        
    </aside>

    <!-- المحتوى الرئيسي -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
        
        <!-- الشريط العلوي المعدل -->
        <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200 px-6 lg:px-10 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            
            <!-- المنتصف: شريط البحث -->
            <livewire:search-summaries />
            
            <!-- الجهة اليسار: الإشعارات وبطاقة المستخدم -->
            <div class="flex items-center gap-3 shrink-0">
                @guest
            <div class=" grid grid-cols-2 gap-2">
                <!-- زر تسجيل الدخول (ثانوي أو بحدود) -->
                <a href="{{ route('login') }}" class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs transition">
                    <svg class="w-3.5 h-3.5 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" x2="3" y1="12" y2="12"/>
                    </svg>
                    <span>دخول</span>
                </a>
                
                <!-- زر إنشاء حساب (بارز ولونه مميز لزيادة الـ Conversion) -->
                <a href="{{ route('register') }}" class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs shadow-sm shadow-sky-600/20 transition">
                    <svg class="w-3.5 h-3.5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="8.5" cy="7" r="4"/>
                        <line x1="20" x2="20" y1="8" y2="14"/>
                        <line x1="23" x2="17" y1="11" y2="11"/>
                    </svg>
                    <span>حساب جديد</span>
                </a>
            </div>
        @endguest
        @auth
            @if(auth()->user()->role === 'student')
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
            @endif
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
                        <a href="{{route('profile.show', auth()->id() )}}" class="relative w-8 h-8 rounded-full overflow-hidden bg-gray-200 shrink-0 shadow-sm border-2 border-white ring-1 ring-gray-200">
                    @if(auth()->user()->avatar)
                        <img 
                            src="{{ asset('storage/' . auth()->user()->avatar ) }}" 
                            alt="{{ auth()->user()->name  }}" 
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
            @endauth
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