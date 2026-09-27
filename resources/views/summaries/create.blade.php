@extends('layouts.app')

@section('content')
<main class="flex-grow p-4 lg:p-8 space-y-6 max-w-5xl mx-auto w-full">

    <!-- عنوان الصفحة -->
    <div class="relative bg-gradient-to-br from-sky-50 via-white to-sky-50 rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-sky-600 text-white flex items-center justify-center shadow-sm flex-shrink-0">
                <i data-lucide="upload-cloud" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-lg font-black text-slate-900">رفع ملخص جديد</h1>
                <p class="text-xs text-slate-500 font-medium mt-1">شارك ملخصك مع باقي الطلاب وساعدهم على التفوق الدراسي</p>
            </div>
        </div>
    </div>

    <form action="{{route('summaries.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf 

        <!-- منطقة رفع الملف -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i data-lucide="file-up" class="w-4 h-4 text-sky-600"></i>
                ملف الملخص
            </h2>

            <label for="summary_file"
                   class="relative flex flex-col items-center justify-center gap-2 w-full py-10 px-4 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 hover:bg-sky-50/50 hover:border-sky-300 transition cursor-pointer text-center">
                <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                    <i data-lucide="upload" class="w-6 h-6"></i>
                </div>
                <span class="text-sm font-bold text-slate-700">اسحب الملف هنا أو اضغط للاختيار</span>
                <span class="text-[11px] text-slate-400">PDF, DOCX, PPTX — بحد أقصى 25 ميجابايت</span>
                <input id="summary_file" name="summary_file" type="file" class="hidden" accept=".pdf,.doc,.docx,.ppt,.pptx">
            </label>

            <!-- معاينة الملف بعد الاختيار (وهمي) -->
            <div class="hidden items-center justify-between gap-3 bg-sky-50 border border-sky-100 rounded-xl p-3" id="file-preview">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white text-sky-600 flex items-center justify-center border border-sky-100">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">اسم_الملف.pdf</p>
                        <p class="text-[10px] text-slate-500">2.4 ميجابايت</p>
                    </div>
                </div>
                <button type="button" class="text-slate-400 hover:text-red-500 transition">
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
                <input id="title" name="title" type="text" required placeholder="مثال: ملخص هياكل البيانات والخوارزميات الشاملة"
                       class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-slate-400">
            </div>

            <livewire:department-subject-select />

            <!-- الوصف -->
            <div class="space-y-1.5">
                <label for="description" class="text-xs font-bold text-slate-600">وصف مختصر</label>
                <textarea id="description" name="description" rows="4" placeholder="اكتب نبذة بسيطة عن محتوى الملخص وما يميزه..."
                          class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-slate-400 resize-none"></textarea>
            </div>

        </div>

        <!-- إعدادات النشر -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i data-lucide="shield-check" class="w-4 h-4 text-sky-600"></i>
                إعدادات النشر
            </h2>

            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" name="agree_terms" required
                       class="mt-0.5 w-4 h-4 rounded border-slate-300 text-sky-600 focus:ring-sky-400">
                <span class="text-xs text-slate-600 leading-relaxed">
                    أقر بأن هذا الملخص من إعدادي الخاص أو لدي الحق في مشاركته، وأنه لا يخالف حقوق الملكية الفكرية لأي طرف آخر.
                </span>
            </label>

            <div class="flex items-center gap-2 bg-amber-50 border border-amber-100 text-amber-700 text-[11px] font-medium rounded-xl p-3">
                <i data-lucide="alert-triangle" class="w-4 h-4 flex-shrink-0"></i>
                <span>سيتم مراجعة الملخص من فريقنا قبل نشره للتأكد من جودته ومطابقته لسياسات المنصة.</span>
            </div>
        </div>

        <!-- أزرار الحفظ -->
        <div class="flex items-center justify-end gap-3">
            <a href="#"
               class="bg-white hover:bg-slate-50 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs border border-slate-200 transition">
                إلغاء
            </a>
            <button type="submit"
                    class="bg-sky-600 hover:bg-sky-500 text-white font-bold py-2.5 px-6 rounded-xl text-xs transition flex items-center gap-2 shadow-sm">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>نشر الملخص</span>
            </button>
        </div>
    </form>
</main>

<script>
    // معاينة اسم الملف المرفوع
    document.getElementById('summary_file')?.addEventListener('change', function (e) {
        const preview = document.getElementById('file-preview');
        if (e.target.files.length > 0) {
            preview.classList.remove('hidden');
            preview.classList.add('flex');
            preview.querySelector('p.font-bold').textContent = e.target.files[0].name;
        }
    });
</script>
@endsection