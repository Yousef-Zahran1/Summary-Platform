<div class="my-6">
    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 py-7 space-y-3">
        <div class="flex flex-wrap gap-3 items-end">


            {{-- فلترة حسب القسم --}}
            <div class="max-w-100 flex-1 min-w-33">
                <label class="block text-[11px] font-bold text-slate-500 mb-1.5">القسم الدراسي</label>
                <select wire:model.live="department"
                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                    <option value="">اختر القسم</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="max-w-100 flex-1 min-w-33">
                <label class="block text-[11px] font-bold text-slate-500 mb-1.5">المادة الدراسية</label>
                <select wire:model.live="subject" {{ $department ? '' : 'disabled' }}
                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition cursor-pointer">
                    @if ($department)
                        <option value="" selected>اختر المادة</option>
                        @foreach ($subjects ?? [] as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    @else
                        <option value="" selected>اختر القسم أولا</option>
                    @endif
                </select>
            </div>

            {{-- الترتيب حسب الوقت --}}
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
    <div class="relative mb-5 mt-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="w-4 h-4 text-slate-400 absolute top-1/2 -translate-y-1/2 right-4">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="search" wire:model.live.debounce.500ms="search" placeholder="ابحث عن ملخص..."
            class="w-full bg-white border border-slate-200 rounded-full py-2.5 pr-10 pl-4 text-xs text-slate-600 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow-sm">
    </div>
</div>