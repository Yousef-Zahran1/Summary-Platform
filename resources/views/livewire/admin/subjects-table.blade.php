<div>
    {{-- استبدل الجزء العلوي (البطاقات الإحصائية) بهذا الـ div --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6 flex items-center justify-between gap-4">
        <div class="flex-1">
            <h1 class="text-xl font-bold text-slate-900 mb-1">إدارة المواد الدراسية</h1>
            <p class="text-sm text-slate-500">
                من هنا يمكنك إضافة وتعديل وحذف المواد الدراسية. لا يمكن حذف مادة إلا إذا كانت خالية من الملخصات.
            </p>
        </div>
        <div class="shrink-0">
            <a href="{{route('admin.subjects.create')}}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl transition shadow-sm">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                إضافة مادة جديدة
            </a>
        </div>
    </div>
    {{-- ==================== شريط البحث والفلترة ==================== --}}
    <div class="my-6">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-4 space-y-3">
            <div class="flex flex-wrap gap-3 py-3 items-end">

                {{-- بحث --}}
                <div class="max-w-100 flex-1 min-w-33">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1.5">بحث</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-4 h-4 text-slate-400 absolute top-1/2 -translate-y-1/2 right-3">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="search" wire:model.live.debounce.500ms="search"
                            placeholder="ابحث باسم المادة أو الكود..."
                            class="w-full bg-white border border-slate-200 rounded-xl py-2.5 pr-9 pl-3 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition">
                    </div>
                </div>

                {{-- القسم --}}
                <div class="max-w-100 flex-1 min-w-33">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1.5">القسم</label>
                    <select wire:model.live="department"
                        class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                        <option value="">كل الأقسام</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

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
        </div>
    </div>

    {{-- ==================== الجدول ==================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 pb-0 flex items-center justify-between flex-wrap gap-4">
            <div>
                @if ($tab === 'all')
                    <h2 class="text-sm font-black text-slate-900">قائمة المواد</h2>
                    <p class="text-xs text-slate-500 mt-0.5">جميع المواد الدراسية المسجلة على المنصة.</p>
                @elseif($tab === 'with')
                    <h2 class="text-sm font-black text-slate-900">مواد بها ملخصات</h2>
                    <p class="text-xs text-slate-500 mt-0.5">المواد التي تحتوي على ملخصات منشورة أو قيد المراجعة.</p>
                @else
                    <h2 class="text-sm font-black text-slate-900">مواد بدون ملخصات</h2>
                    <p class="text-xs text-slate-500 mt-0.5">مواد لم يتم إضافة أي ملخصات إليها بعد.</p>
                @endif
            </div>

            <span class="text-xs font-bold text-slate-500">
                عدد النتائج: {{ $subjects->total() }}
            </span>
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-y border-slate-200 text-[11px] font-bold text-slate-500">
                        <th class="py-3 pl-2 pr-1 w-6 text-center">#</th>
                        <th class="py-3 px-6">اسم المادة</th>
                        <th class="py-3 px-6">الكود</th>
                        <th class="py-3 px-6">عدد الساعات</th>
                        <th class="py-3 px-6">القسم</th>
                        <th class="py-3 px-6 text-center">عدد الملخصات</th>
                        <th class="py-3 px-6">تاريخ الإضافة</th>
                        <th class="py-3 px-6 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">

                    @forelse($subjects as $subject)
                        <tr wire:key="subject-row-{{ $subject->id }}" class="hover:bg-slate-50/60 transition">
                            <td class="py-4 pl-2 pr-1 text-center">
                                <span class="inline-flex items-center gap-0.5 text-[9px] font-bold text-slate-400">
                                    <span>#</span>
                                    <span
                                        class="text-slate-500">{{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}</span>
                                </span>
                            </td>

                            {{-- اسم المادة --}}
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <a href="{{ route('subjects.show', $subject->id) }}"
                                        class="text-slate-800 font-bold hover:text-blue-600 hover:underline transition">
                                        {{ $subject->name }}
                                    </a>
                                </div>
                            </td>

                            {{-- الكود --}}
                            <td class="py-4 px-6">
                                @if ($subject->code)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $subject->code }}
                                    </span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>

                            {{-- عدد الساعات --}}
                            <td class="py-4 px-6">
                                @if ($subject->Gredit_hours)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $subject->Gredit_hours }}
                                    </span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>

                            {{-- القسم --}}
                            <td class="py-4 px-6">
                                @if ($subject->department)
                                    <a href="{{ route('departments.show', $subject->department->id) }}"
                                        class="text-slate-700 hover:text-blue-600 hover:underline transition">
                                        {{ $subject->department->name }}
                                    </a>
                                @else
                                    <span class="text-slate-400">غير محدد</span>
                                @endif
                            </td>

                            {{-- عدد الملخصات --}}
                            <td class="py-4 px-6 text-center">
                                @if ($subject->summaries_count > 0)
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                        </svg>
                                        {{ $subject->summaries_count }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-50 text-slate-500 border border-slate-200">
                                        لا يوجد
                                    </span>
                                @endif
                            </td>

                            {{-- التاريخ --}}
                            <td class="py-4 px-6 text-slate-400">
                                {{ $subject->created_at->diffForHumans() }}
                            </td>

                            {{-- الإجراءات --}}
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-1.5">


                                    {{-- تعديل --}}
                                    <a href=""
                                        class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition"
                                        title="تعديل">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>

                                    {{-- حذف --}}
                                    @if ($subject->summaries_count > 0)
                                        <button type="button" disabled
                                            class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition opacity-40 cursor-not-allowed "
                                            title="لا يمكن الحذف - المادة تحتوي على ملخصات">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    @else
                                        <button type="button"
                                            wire:click="$dispatch('confirmAction', {
                                                component: 'admin.subjects-table',
                                                method: 'deleteSubject',
                                                params: { id: {{ $subject->id }} },
                                                title: 'حذف المادة',
                                                message: 'هل أنت متأكد من حذف هذه المادة نهائياً؟ لن تتمكن من استرجاعها.',
                                                confirmText: 'نعم، احذف',
                                                cancelText: 'إلغاء'
                                            })"
                                            class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer"
                                            title="حذف">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400 text-xs font-semibold">
                                لا يوجد مواد لعرضها حالياً
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <x-pagination-department :paginator="$subjects" :livewire="true"/>

</div>
