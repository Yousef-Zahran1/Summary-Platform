@extends('layouts.app')

@section('content')

<main class="flex-grow p-4 lg:p-8 space-y-6 max-w-5xl mx-auto w-full">
    <x-messages />
    <!-- عنوان الصفحة -->
    <div class="relative bg-gradient-to-br from-sky-50 via-white to-sky-50 rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-sky-600 text-white flex items-center justify-center shadow-sm flex-shrink-0">
                <i data-lucide="file-edit" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-lg font-black text-slate-900">تعديل الملخص الدراسي (وضع المعاينة)</h1>
                <p class="text-xs text-slate-500 font-medium mt-1">قم بتحديث بيانات الملخص أو استبدال الملف المرفق إذا لزم الأمر</p>
            </div>
        </div>
    </div>

    <form action="{{route('summaries.update' , $summary->id)}}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf 
        @method('PUT')

        <!-- منطقة رفع الملف -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i data-lucide="file-up" class="w-4 h-4 text-sky-600"></i>
                ملف الملخص الحالي والمرفقات
            </h2>

            <!-- عرض الملف الحالي -->
            <div class="flex items-center justify-between gap-3 bg-sky-50/60 border border-sky-100 rounded-2xl p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white text-sky-600 flex items-center justify-center border border-sky-100 shadow-xs">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">الملف الحالي المرفق.pdf</p>
                        <a href="{{ $summary->file_path }}" target="_blank" class="text-[11px] text-sky-600 hover:underline font-semibold">تحميل أو معاينة الملف الحالي</a>
                    </div>
                </div>
                <span class="text-[10px] text-slate-400 font-medium bg-white px-2.5 py-1 rounded-lg border border-slate-100">PDF</span>
            </div>

            <label for="summary_file"
                   class="relative flex flex-col items-center justify-center gap-2 w-full py-8 px-4 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 hover:bg-sky-50/50 hover:border-sky-300 transition cursor-pointer text-center">
                <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                    <i data-lucide="upload" class="w-6 h-6"></i>
                </div>
                <span class="text-sm font-bold text-slate-700">استبدال الملف بملف جديد (اختياري)</span>
                <span class="text-[11px] text-slate-400">PDF, DOCX, PPTX — بحد أقصى 25 ميجابايت</span>
                <input id="summary_file" name="summary_file" type="file" class="hidden" accept=".pdf,.doc,.docx,.ppt,.pptx">
            </label>

            <!-- معاينة الملف الجديد بعد الاختيار -->
            <div class="hidden items-center justify-between gap-3 bg-emerald-50 border border-emerald-100 rounded-xl p-3" id="file-preview">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white text-emerald-600 flex items-center justify-center border border-emerald-100">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800" id="file-name-display">اسم_الملف.pdf</p>
                        <p class="text-[10px] text-slate-500">ملف جديد جاهز للرفع</p>
                    </div>
                </div>
                <button type="button" id="remove-file" class="text-slate-400 hover:text-red-500 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- بيانات الملخص -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4 text-sky-600"></i>
                تفاصيل الملخص
            </h2>

            <!-- العنوان -->
            <div class="space-y-1.5">
                <label for="title" class="text-xs font-bold text-slate-600">عنوان الملخص</label>
                <input id="title" name="title" type="text" value="{{ $summary->title }}" required 
                            class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-slate-400">
            </div>

            
            <livewire:department-subject-select :department_id="$summary->subject->department_id" :subject_id="$summary->subject_id"/>

            <!-- الوصف -->
            <div class="space-y-1.5">
                <label for="description" class="text-xs font-bold text-slate-600">وصف مختصر</label>
                <textarea id="description" name="description" rows="4" 
                            class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-slate-400 resize-none">{{ $summary->description }}</textarea>
            </div>
        </div>

        <!-- إعدادات النشر والتعديل -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i data-lucide="shield-check" class="w-4 h-4 text-sky-600"></i>
                حالة التحديث
            </h2>
            <div class="flex items-center gap-2 bg-sky-50 border border-sky-100 text-sky-700 text-[11px] font-medium rounded-xl p-3">
                <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
                <span>عند تعديل الملخص، قد يخضع لمراجعة سريعة من فريق الإشراف لضمان جودة المحتوى.</span>
            </div>
        </div>

        <!-- أزرار الحفظ -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{route('summaries.show', $summary->id)}}"
                class="bg-white hover:bg-slate-50 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs border border-slate-200 transition">
                إلغاء
            </a>
            <button type="submit"
                    class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 px-6 rounded-xl text-xs transition flex items-center gap-2 shadow-sm shadow-sky-600/20">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>حفظ التعديلات</span>
            </button>
        </div>
    </form>
</main>

<script>
    // تفعيل الأيقونات لو لسه مشتغلتش
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // تفعيل معاينة وتغيير اسم الملف المرفوع الجديد
    document.getElementById('summary_file')?.addEventListener('change', function (e) {
        const preview = document.getElementById('file-preview');
        if (e.target.files.length > 0) {
            preview.classList.remove('hidden');
            preview.classList.add('flex');
            document.getElementById('file-name-display').textContent = e.target.files[0].name;
        }
    });

    document.getElementById('remove-file')?.addEventListener('click', function () {
        const fileInput = document.getElementById('summary_file');
        const preview = document.getElementById('file-preview');
        fileInput.value = '';
        preview.classList.remove('flex');
        preview.classList.add('hidden');
    });
</script>
@endsection