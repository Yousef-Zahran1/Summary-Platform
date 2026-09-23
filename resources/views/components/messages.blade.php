@if($errors->any() || session('success'))
    <div id="toast-notification" class="fixed bottom-6 right-6 z-50 max-w-md w-full transition-all duration-500 transform translate-y-0 opacity-100">
        
        {{-- صندوق الأخطاء --}}
        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl shadow-xl backdrop-blur-md mb-3">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600"></i>
                        <span class="text-xs sm:text-sm font-bold">راجع البيانات دي:</span>
                    </div>
                    <button onclick="document.getElementById('toast-notification').remove();" class="text-rose-400 hover:text-rose-700 transition">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- صندوق النجاح --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl flex items-center justify-between shadow-xl backdrop-blur-md">
                <div class="flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                    <span class="text-xs sm:text-sm font-bold">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('toast-notification').remove();" class="text-emerald-500 hover:text-emerald-700 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

    </div>

    {{-- سكريبت التايمر للاختفاء التلقائي --}}
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-notification');
            if (toast) {
                // تأثير تلاشي قبل الحذف
                toast.style.transition = 'all 0.5s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(() => toast.remove(), 500); // إزالة العنصر بعد انتهاء التلاشي
            }
        }, 4000); // تختفي بعد 4 ثواني (تقدر تزوّت أو تقلل الرقم حسب ما تحب، 4000 = 4 ثواني)
    </script>
@endif