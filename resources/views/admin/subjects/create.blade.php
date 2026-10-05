@extends('layouts.app')

@section('content')
    <main class="flex-grow p-4 lg:p-8 space-y-6 max-w-5xl mx-auto w-full" dir="rtl">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <a href="{{ route('admin.subjects.index') }}" class="hover:text-sky-600 transition">لوحة التحكم</a>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="{{ route('admin.subjects.index') }}" class="hover:text-sky-600 transition">المواد</a>
            <i data-lucide="chevron-left" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-bold">إنشاء مادة جديدة</span>
        </nav>

        {{-- عنوان الصفحة --}}
        <div class="relative bg-gradient-to-br from-sky-50 via-white to-indigo-50 rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-600 text-white flex items-center justify-center shadow-sm flex-shrink-0">
                    <i data-lucide="book-plus" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-lg font-black text-slate-900">إنشاء مادة جديدة</h1>
                    <p class="text-xs text-slate-500 font-medium mt-1">
                        أضف مادة أكاديمية جديدة للمنصة، واختر القسم التابعة له.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{route('admin.subjects.store')}}" method="POST" class="space-y-6">
            @csrf
            @method('post')
            
            {{-- ==================== 1. البيانات الأساسية ==================== --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-5">
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-sky-600"></i>
                    البيانات الأساسية
                </h2>

                {{-- القسم --}}
                <div class="space-y-1.5">
                    <label for="department_id" class="text-xs font-bold text-slate-600">
                        القسم <span class="text-rose-500">*</span>
                    </label>
                    <select id="department_id" name="department_id" required
                        class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 cursor-pointer">
                        <option value="">— اختر القسم —</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="text-[11px] text-rose-600 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- اسم المادة --}}
                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-bold text-slate-600">
                        اسم المادة <span class="text-rose-500">*</span>
                    </label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        placeholder="مثال: هياكل البيانات والخوارزميات"
                        class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-slate-400">
                    @error('name')
                        <p class="text-[11px] text-rose-600 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- كود المادة --}}
                <div class="space-y-1.5">
                    <label for="code" class="text-xs font-bold text-slate-600">
                        كود المادة <span class="text-rose-500">*</span>
                    </label>
                    <input id="code" name="code" type="text" required value="{{ old('code') }}"
                        placeholder="مثال: CS201"
                        class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-slate-400 font-mono">
                    @error('code')
                        <p class="text-[11px] text-rose-600 font-bold">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- أزرار الحفظ --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.subjects.index') }}"
                    class="bg-white hover:bg-slate-50 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs border border-slate-200 transition">
                    إلغاء
                </a>
                <button type="submit" id="submit-btn"
                    class="bg-sky-600 hover:bg-sky-500 text-white font-bold py-2.5 px-6 rounded-xl text-xs transition flex items-center gap-2 shadow-sm">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span id="submit-text">إنشاء المادة</span>
                </button>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ==================== منع الإرسال المزدوج ====================
            const form = document.querySelector('form[action*="admin/subjects"]');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            let isSubmitting = false;

            form?.addEventListener('submit', function (e) {
                if (isSubmitting) {
                    e.preventDefault();
                    return false;
                }
                isSubmitting = true;
                submitBtn.disabled = true;
                submitText.textContent = 'جاري الإنشاء...';
            });
        });
    </script>
@endsection