<div>
    <!-- ==================== بطاقات الإحصائيات (تابات) ==================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- البطاقة الأولى: الطلاب -->
        <div wire:click="changeTab('students')"
            class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                    transition-all duration-200 ease-out
                    hover:shadow-md hover:-translate-y-0.5
                    active:scale-[0.97] active:shadow-sm
                    {{ $tab === 'students'
                        ? 'bg-blue-50 border-blue-400 ring-2 ring-blue-400/40 shadow-md'
                        : 'bg-white border-slate-200/80 hover:border-blue-300' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold {{ $tab === 'students' ? 'text-blue-700' : 'text-slate-500' }}">
                    الطلاب
                </span>
                <div
                    class="w-8 h-8 rounded-xl flex items-center justify-center
                            {{ $tab === 'students' ? 'bg-blue-100 text-blue-700' : 'bg-blue-50 text-blue-600' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $studentsCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-blue-600">مسجل بالمنصة</span>
            </div>
        </div>

        <!-- البطاقة الثانية: المسؤولون -->
        <div wire:click="changeTab('admins')"
            class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                    transition-all duration-200 ease-out
                    hover:shadow-md hover:-translate-y-0.5
                    active:scale-[0.97] active:shadow-sm
                    {{ $tab === 'admins'
                        ? 'bg-amber-50 border-amber-400 ring-2 ring-amber-400/40 shadow-md'
                        : 'bg-white border-slate-200/80 hover:border-amber-300' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold {{ $tab === 'admins' ? 'text-amber-700' : 'text-slate-500' }}">
                    المشرفون (Admins)
                </span>
                <div
                    class="w-8 h-8 rounded-xl flex items-center justify-center
                            {{ $tab === 'admins' ? 'bg-amber-100 text-amber-700' : 'bg-amber-50 text-amber-600' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $adminsCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-slate-400">صلاحيات كاملة</span>
            </div>
        </div>

        <!-- البطاقة الرابعة: المحظورون -->
        <div wire:click="changeTab('banned')"
            class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                    transition-all duration-200 ease-out
                    hover:shadow-md hover:-translate-y-0.5
                    active:scale-[0.97] active:shadow-sm
                    {{ $tab === 'banned'
                        ? 'bg-rose-50 border-rose-400 ring-2 ring-rose-400/40 shadow-md'
                        : 'bg-white border-slate-200/80 hover:border-rose-300' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold {{ $tab === 'banned' ? 'text-rose-700' : 'text-slate-500' }}">
                    الحسابات المحظورة
                </span>
                <div
                    class="w-8 h-8 rounded-xl flex items-center justify-center
                            {{ $tab === 'banned' ? 'bg-rose-100 text-rose-700' : 'bg-rose-50 text-rose-600' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $bannedUsersCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-rose-600">محظور</span>
            </div>
        </div>

        <!-- البطاقة الثالثة: المحذوفون -->
        <div wire:click="changeTab('deleted')"
            class="p-5 cursor-pointer rounded-2xl border shadow-2xs space-y-3
                    transition-all duration-200 ease-out
                    hover:shadow-md hover:-translate-y-0.5
                    active:scale-[0.97] active:shadow-sm
                    {{ $tab === 'deleted'
                        ? 'bg-rose-50 border-rose-400 ring-2 ring-rose-400/40 shadow-md'
                        : 'bg-white border-slate-200/80 hover:border-rose-300' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold {{ $tab === 'deleted' ? 'text-rose-700' : 'text-slate-500' }}">
                    الحسابات المحذوفة
                </span>
                <div
                    class="w-8 h-8 rounded-xl flex items-center justify-center
                            {{ $tab === 'deleted' ? 'bg-rose-100 text-rose-700' : 'bg-rose-50 text-rose-600' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $deletedUsersCount ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-rose-600">محذوف</span>
            </div>
        </div>

    </div>

    {{-- ==================== شريط البحث والفلترة ==================== --}}
    <div class="my-6">
        <form method="GET" action="" class="bg-white border border-slate-200/80 rounded-2xl p-4 space-y-3">
            <div class="flex flex-wrap gap-3 py-3 items-end">

                {{-- فلترة حسب القسم --}}
                @if ($tab === 'students' || $tab === 'banned')
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">القسم الدراسي</label>
                        <select wire:model.live="department"
                            class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="">كل الأقسام</option>
                            <option value="undefined">غير محدد</option>
                            @foreach ($basicDepartments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- فلترة حسب المستوى --}}
                    <div class="max-w-100 flex-1 min-w-33">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5">المستوى الدراسي</label>
                        <select wire:model.live="level"
                            class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                            <option value="">كل المستويات</option>
                            <option value="undefined">غير محدد</option>
                            <option value="الأول">المستوى الأول</option>
                            <option value="الثاني">المستوى الثاني</option>
                            <option value="الثالث">المستوى الثالث</option>
                            <option value="الرابع">المستوى الرابع</option>
                        </select>
                    </div>
                @endif

                {{-- الترتيب --}}
                <div class="max-w-100 flex-1 min-w-33">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1.5">الترتيب</label>
                    <select wire:model.live="sort"
                        class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                        <option value="latest">الأحدث أولاً</option>
                        <option value="oldest">الأقدم أولاً</option>
                        <option value="name_asc">الاسم (أ - ي)</option>
                        <option value="name_desc">الاسم (ي - أ)</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="relative mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="w-4 h-4 text-slate-400 absolute top-1/2 -translate-y-1/2 right-4">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="search" wire:model.live.debounce.500ms="search"
            placeholder="ابحث عن مستخدم بالاسم أو البريد..."
            class="w-full bg-white border border-slate-200 rounded-full py-2.5 pr-10 pl-4 text-xs text-slate-600 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow-sm">
    </div>

    {{-- ==================== الجدول ==================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">

        <div class="p-6 pb-0 flex items-center justify-between flex-wrap gap-4">
            <div>
                @if ($tab === 'students')
                    <h2 class="text-sm font-black text-slate-900">قائمة الطلاب</h2>
                    <p class="text-xs text-slate-500 mt-0.5">عرض ومتابعة جميع الطلاب المسجلين بالمنصة.</p>
                @elseif($tab === 'admins')
                    <h2 class="text-sm font-black text-slate-900">قائمة المسؤولين</h2>
                    <p class="text-xs text-slate-500 mt-0.5">التحكم في صلاحيات المشرفين ومسؤولي النظام.</p>
                @elseif($tab === 'deleted')
                    <h2 class="text-sm font-black text-slate-900">الحسابات المحذوفة</h2>
                    <p class="text-xs text-slate-500 mt-0.5">عرض الحسابات التي تم حذفها مع إمكانية استرجاعها.</p>
                @else
                    <h2 class="text-sm font-black text-slate-900">الحسابات المحظورة</h2>
                    <p class="text-xs text-slate-500 mt-0.5">الحسابات التي تم حظرها من الوصول إلى المنصة.</p>
                @endif
            </div>
            <span class="text-xs font-bold text-slate-500">
                عدد النتائج: {{ $users->total() }}
            </span>
        </div>

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

                    @forelse($users as $user)
                        <tr wire:key="user-row-{{ $user->id }}" class="hover:bg-slate-50/60 transition">
                            <td class="py-4 pl-2 pr-1 text-center">
                                <span class="inline-flex items-center gap-0.5 text-[9px] font-bold text-slate-400">
                                    <span>#</span>
                                    <span
                                        class="text-slate-500">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-2 font-bold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center shrink-0 border border-slate-200">
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-full h-full text-slate-400" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M12 12.75a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 2.25c-4.14 0-7.5 2.35-7.5 5.25v.75a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75V20.25c0-2.9-3.36-5.25-7.5-5.25Z" />
                                            </svg>
                                        @endif
                                    </div>
                                    @if ($user->role === 'admin')
                                        <div class="text-slate-700 font-medium truncate max-w-[150px] inline-block align-middle duration-300">{{ $user->name }}</div>
                                    @else
                                        <a href="{{ route('profile.show', $user->id) }}"
                                            class="text-slate-700 duration-300 truncate max-w-[150px] inline-block align-middle duration-300 hover:underline hover:text-slate-900 font-medium">
                                            {{ $user->name }}
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slate-600 truncate max-w-[180px] inline-block align-middle duration-300">{{ $user->email ?? '—' }}</td>
                            <td class="py-4 px-4 text-slate-500">
                                @if ($user->role === 'admin')
                                    —
                                @else
                                    {{ $user->basic_department->name ?? 'غير محدد' }}
                                @endif
                            </td>
                            <td class="py-4 px-4 text-slate-500">
                                @if ($user->role === 'admin')
                                    —
                                @else
                                    {{ $user->level ?? 'غير محدد' }}
                                @endif
                            </td>
                            <td class="py-4 px-4 text-slate-400">
                                {{ $user->created_at?->diffForHumans() ?? '—' }}
                            </td>
                            <td class="py-4 px-4">
                                @if ($user->trashed())
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200/60">محذوف</span>
                                @elseif($user->role === 'admin')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200/60">مسؤول
                                        (Admin)</span>
                                @elseif($user->is_banned)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200/60">محظور</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">نشط</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if ($user->id == auth()->id())
                                    <span class="text-[11px] text-slate-400 font-medium">لا يمكن تعديل حسابك</span>
                                @else
                                    <div class="flex items-center justify-center gap-1.5">

                                        {{--استرجاع --}}
                                        @if ($user->trashed())
                                            <button type="button"
                                                wire:click="$dispatch('confirmAction', {
                                                    component: 'admin.users-table',
                                                    method: 'restoreUser',
                                                    params: { id: {{ $user->id }} },
                                                    title: 'إسترجاع المستخدم',
                                                    message: 'هل أنت متأكد من إسترجاع هذا المستخدم؟.',
                                                    confirmText: 'نعم، إسترجاع',
                                                    cancelText: 'إلغاء'
                                                })"
                                                wire:loading.attr="disabled"
                                                class="cursor-pointer p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                                title="استرجاع">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <polyline points="1 4 1 10 7 10"></polyline>
                                                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                                </svg>
                                            </button>
                                        @endif

                                        {{--فك الحظر--}}
                                        @if ($user->is_banned && !$user->trashed())
                                            <button type="button"
                                                wire:click="$dispatch('confirmAction', {
                                                    component: 'admin.users-table',
                                                    method: 'unbanUser',
                                                    params: { id: {{ $user->id }} },
                                                    title: 'فك حظر المستخدم',
                                                    message: 'هل أنت متأكد من فك حظر هذا المستخدم؟.',
                                                    confirmText: 'نعم،فك الحظر',
                                                    cancelText: 'إلغاء'
                                                })"
                                                wire:loading.attr="disabled"
                                                class="cursor-pointer p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                                title="فك الحظر">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="4.93" y1="4.93" x2="19.07"
                                                        y2="19.07"></line>
                                                </svg>
                                            </button>
                                        @endif

                                        {{--حظر--}}
                                        @if (!$user->trashed() && !$user->is_banned && $user->role === 'student')
                                            <button type="button"
                                                wire:click="$dispatch('confirmAction', {
                                                    component: 'admin.users-table',
                                                    method: 'banUser',
                                                    params: { id: {{ $user->id }} },
                                                    title: 'حظر المستخدم',
                                                    message: 'هل أنت متأكد من حظر هذا المستخدم؟.',
                                                    confirmText: 'نعم، حظر',
                                                    cancelText: 'إلغاء'
                                                })"
                                                wire:loading.attr="disabled"
                                                class="cursor-pointer p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                title="حظر المستخدم">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="4.93" y1="4.93" x2="19.07"
                                                        y2="19.07"></line>
                                                </svg>
                                            </button>
                                        @endif

                                        {{-- حذف --}}
                                        @if (!$user->trashed())
                                            <button type="button"
                                                wire:click="$dispatch('confirmAction', {
                                                    component: 'admin.users-table',
                                                    method: 'deleteUser',
                                                    params: { id: {{ $user->id }} },
                                                    title: 'حذف مستخدم',
                                                    message: 'هل أنت متأكد من حذف هذا المستخدم؟.',
                                                    confirmText: 'نعم، احذف',
                                                    cancelText: 'إلغاء'
                                                })"
                                                wire:loading.attr="disabled"
                                                class="cursor-pointer p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                title="حذف">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10"
                                                        y2="17"></line>
                                                    <line x1="14" y1="11" x2="14"
                                                        y2="17"></line>
                                                </svg>
                                            </button>
                                        @endif

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

    {{-- ==================== Pagination ==================== --}}
    <div class="flex items-center justify-center pt-6 mt-6 border-t border-slate-200">
        <div class="flex items-center gap-1.5 flex-wrap justify-center">

            {{-- السابق --}}
            @if ($users->onFirstPage())
                <span
                    class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            @else
                <a href="{{ $users->previousPageUrl() }}"
                    class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            @endif

            {{-- الأرقام --}}
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                    <span
                        class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                        class="w-9 h-9 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition cursor-pointer">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- التالي --}}
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}"
                    class="w-9 h-9 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-slate-700 hover:bg-slate-50 text-xs transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            @else
                <span
                    class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-300 bg-slate-50 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
            @endif

        </div>
    </div>
</div>
