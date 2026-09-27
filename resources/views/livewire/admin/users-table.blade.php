<div>
<!-- بطاقات الإحصائيات السريعة للمستخدمين -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- البطاقة الأولى: إجمالي المستخدمين -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">إجمالي المستخدمين</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $users->total() ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-blue-600">مسجل بالمنصة</span>
            </div>
        </div>

        <!-- البطاقة الثالثة: مشرفي ومسؤولي النظام -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">المشرفون (Admins)</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $adminsCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-slate-400">صلاحيات كاملة</span>
            </div>
        </div>

        <!-- البطاقة الثانية: الحسابات المحذوفة -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">الحسابات المحذوفة</span>
                <div class="w-8 h-8 rounded-xl bg-[#ff3e251f] text-[#ff3e25e5] flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $deletedUsersCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-[#ff3e25e5]">محذوف</span>
            </div>
        </div>

        <!-- البطاقة الرابعة: الحسابات المحظورة -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">الحسابات المحظورة</span>
                <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $bannedUsersCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-rose-600">محظور</span>
            </div>
        </div>

    </div>

    {{-- ==================== شريط البحث والفلترة ==================== --}}
        <div class="">
            <form method="GET" action="" class="bg-white border border-slate-200/80 rounded-2xl p-4 space-y-3">
                <div class="flex flex-wrap gap-3 items-end">

                    
                    {{-- فلترة حسب القسم --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">القسم الدراسي</label>
                        <select name="department" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="">كل الأقسام</option>
                            @foreach(($departments ?? collect()) as $dept)
                                <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                            {{-- بيانات وهمية للعرض فقط --}}
                            @if(!isset($departments))
                                <option value="1">علوم الحاسب</option>
                                <option value="2">نظم المعلومات</option>
                                <option value="3">هندسة البرمجيات</option>
                                <option value="4">الأمن السيبراني</option>
                            @endif
                        </select>
                    </div>

                    {{-- فلترة حسب المستوى --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">المستوى الدراسي</label>
                        <select name="level" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="">كل المستويات</option>
                            <option value="1" {{ request('level') == 1 ? 'selected' : '' }}>المستوى الأول</option>
                            <option value="2" {{ request('level') == 2 ? 'selected' : '' }}>المستوى الثاني</option>
                            <option value="3" {{ request('level') == 3 ? 'selected' : '' }}>المستوى الثالث</option>
                            <option value="4" {{ request('level') == 4 ? 'selected' : '' }}>المستوى الرابع</option>
                        </select>
                    </div>

                    {{-- الترتيب حسب الوقت --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">الترتيب</label>
                        <select name="sort" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث أولاً</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم أولاً</option>
                        </select>
                    </div>

                </div>

            </form>
        </div>

        <div class="relative mb-5">
            <i data-lucide="search" class="w-4 h-4  text-slate-400 absolute top-1/2 -translate-y-1/2 right-4"></i>
            <input type="search"  placeholder="ابحث عن مستخدم..."
                class="w-full bg-white border border-slate-200 rounded-full py-2.5 pr-10 pl-4 text-xs text-slate-600 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow-sm">
        </div>
    <!-- الجزء السفلي: جدول إدارة المستخدمين بالمنصة -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        <div class="p-6 pb-0 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-sm font-black text-slate-900">قائمة مستخدمي المنصة</h2>
                <p class="text-xs text-slate-500 mt-0.5">التحكم في صلاحيات المستخدمين، ترقية المشرفين، أو حظر الحسابات المخالفة.</p>
            </div>
        </div>

        
        {{-- ==================== نهاية شريط البحث والفلترة ==================== --}}

        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-y border-slate-200 text-[11px] font-bold text-slate-500">
                        <th class="py-3 pl-2 pr-1 w-6 text-center">#</th>
                        <th class="py-3 px-6">اسم المستخدم</th>
                        <th class="py-3 px-6">البريد الإلكتروني</th>
                        <th class="py-3 px-6">القسم الدراسي</th>
                        <th class="py-3 px-6">المستوى</th>
                        <th class="py-3 px-6">تاريخ الانضمام</th>
                        <th class="py-3 px-6">الصلاحية / الحالة</th>
                        <th class="py-3 px-6 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                    
                    @forelse($users ?? [] as $user)
                        <tr class="hover:bg-slate-50/60 transition text-center">
                            {{-- رقم الصف + علامة # صغيرة جداً --}}
                            <td class="py-4 pl-2 pr-1 text-center">
                                <span class="inline-flex items-center gap-0.5 text-[9px] font-bold text-slate-400">
                                    <span>#</span>
                                    <span class="text-slate-500">{{ $loop->iteration + (($users->currentPage() - 1) * $users->perPage()) }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-2 font-bold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center shrink-0 border border-slate-200">
                                        @if($user->avatar ?? false)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 12.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 2.25c-4.14 0-7.5 2.35-7.5 5.25v.75a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75V20.25c0-2.9-3.36-5.25-7.5-5.25Z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    @if(($user->role ?? '') === 'admin')
                                        <div class="text-slate-700 duration-300 font-medium">{{ $user->name ?? '—' }}</div>
                                    @else
                                        <a href="{{ route('profile.show', $user->id ?? '#') }}" class="text-slate-700 duration-300 hover:underline hover:text-slate-900 font-medium">
                                            {{ $user->name ?? '—' }}
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slate-600">{{ $user->email ?? '—' }}</td>
                            <td class="py-4 px-4 text-slate-500">
                                @if(($user->role ?? '') === 'admin')
                                    —
                                @else
                                    {{ $user->basic_department->name ?? 'غير محدد' }}
                                @endif
                            </td>
                            <td class="py-4 px-4 text-slate-500">
                                @if(($user->role ?? '') === 'admin')
                                    —
                                @else
                                    {{ $user->level ?? 'غير محدد' }}
                                @endif
                            </td>
                            <td class="py-4 px-4 text-slate-400">
                                {{ isset($user->created_at) ? $user->created_at->diffForHumans() : '—' }}
                            </td>
                            <td class="py-4 px-4">
                                @if(($user->role ?? '') === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200/60">
                                        مسؤول (Admin)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        طالب / 
                                        <span class="inline-flex items-center gap-1 text-[#22a516] text-[10px] font-bold px-2 py-0.5 rounded-full">
                                            نشط
                                        </span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if(($user->id ?? null) == auth()->id())
                                    <span class="text-[11px] text-slate-400 font-medium">لا يمكن تعديل حسابك</span>
                                @else
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="#" class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="تعديل الصلاحيات">
                                        <i data-lucide="shield" class="w-4 h-4"></i>
                                    </a>
                                    <a href="#" class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="حظر المستخدم">
                                        <i data-lucide="ban" class="w-4 h-4 text-amber-600"></i>
                                    </a>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-400 text-xs font-semibold">
                                لا يوجد مستخدمون لعرضهم حالياً
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        
    </div>

    <!-- نظام التصفح (Pagination) -->
    @if (isset($users) && $users->hasPages())
    <div class="flex items-center justify-center pt-6 border-t border-slate-200">
        <div class="flex items-center gap-1.5 flex-wrap justify-center">
            
            {{-- زر الصفحة السابقة --}}
            @if ($users->onFirstPage())
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
            @else
                <a href="{{ $users->previousPageUrl() }}" 
                   class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            @endif

            {{-- أرقام الصفحات --}}
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                    <span class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" 
                       class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition cursor-pointer">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- زر الصفحة التالية --}}
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" 
                   class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </a>
            @else
                <span class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </span>
            @endif

        </div>
    </div>
    @endif
</div>
