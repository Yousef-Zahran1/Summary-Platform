@extends('layouts.app')

@section("content")
        <!-- محتوى صفحة الإعدادات مع تفعيل Alpine.js -->
        <main class="flex-grow p-6 lg:p-8 space-y-6 max-w-5xl mx-auto w-full" x-data="{ activeTab: 'profile' }">
            
            <!-- عنوان الصفحة -->
            <div class="flex items-center gap-3 pt-2">
                <div class="text-sky-600">
                    <i data-lucide="settings" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">إعدادات الحساب</h1>
                    <p class="text-xs text-gray-500 mt-0.5">إدارة إعدادات الحساب، الأمان، والتفضيلات الشخصية</p>
                </div>
            </div>

            <!-- تبويبات الإعدادات الأفقية -->
            <div class="flex items-center gap-2 border-b border-gray-200 pb-3 text-xs overflow-x-auto">
                <button type="button" @click="activeTab = 'profile'" 
                        :class="activeTab === 'profile' ? 'bg-sky-600 text-white font-medium shadow-sm' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 font-medium'"
                        class="px-4 py-2 rounded-xl shrink-0 transition cursor-pointer">
                    الحساب الشخصي
                </button>
                <button type="button" @click="activeTab = 'security'" 
                        :class="activeTab === 'security' ? 'bg-sky-600 text-white font-medium shadow-sm' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 font-medium'"
                        class="px-4 py-2 rounded-xl shrink-0 transition cursor-pointer">
                    الأمان وكلمة المرور
                </button>
                <button type="button" @click="activeTab = 'notifications'" 
                        :class="activeTab === 'notifications' ? 'bg-sky-600 text-white font-medium shadow-sm' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 font-medium'"
                        class="px-4 py-2 rounded-xl shrink-0 transition cursor-pointer">
                    الإشعارات
                </button>
                <button type="button" @click="activeTab = 'appearance'" 
                        :class="activeTab === 'appearance' ? 'bg-sky-600 text-white font-medium shadow-sm' : 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 font-medium'"
                        class="px-4 py-2 rounded-xl shrink-0 transition cursor-pointer">
                    المظهر
                </button>
            </div>

            <!-- محتوى تبويب: الحساب الشخصي -->
            <div x-show="activeTab === 'profile'" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 lg:p-8 space-y-6">
                <h2 class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-4">المعلومات الأساسية</h2>

                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-sky-600 text-white font-bold flex items-center justify-center text-xl shadow-md">
                        ي
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2">
                            <label class="cursor-pointer bg-gray-50 hover:bg-gray-100 active:scale-95 text-gray-700 text-xs font-semibold px-4 py-2 rounded-xl transition-all duration-150 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"></path>
                </svg>
                <span>تغيير الصورة</span>
                <input type="file" class="hidden" accept="image/png, image/jpeg">
            </label>

            <!-- زر إزالة الصورة -->
            <button type="button" class="bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold px-3 py-2 rounded-xl transition-all duration-150 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.108 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                </svg>
                <span>إزالة</span>
            </button>
                        </div>
                        <p class="text-[11px] text-gray-400">JPG أو PNG بحد أقصى 2 ميجابايت.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">الاسم الكامل</label>
                        <input type="text" value="يوسف زهران" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                    </div>

                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">البريد الإلكتروني</label>
                        <input type="email" value="yousef@example.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                    </div>

                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">الكلية / القسم</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                            <option>علوم الحاسب</option>
                            <option>فيزياء</option>
                            <option>رياضيات</option>
                            <option>كيمياء</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">المرحلة الدراسية</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                            <option>الفرقة الثانية</option>
                            <option>الفرقة الأولى</option>
                            <option>الفرقة الثالثة</option>
                            <option>الفرقة الرابعة</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5 text-xs">
                    <label class="font-semibold text-gray-700 block">نبذة مختصرة</label>
                    <textarea rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 text-gray-800 focus:outline-none focus:border-sky-500" placeholder="اكتب نبذة قصيرة عن اهتماماتك الدراسية...">مهتم ببرمجة وتطوير وتلخيص المراجع الأكاديمية.</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" class="bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 text-xs font-semibold px-5 py-2.5 rounded-xl transition">
                        إلغاء
                    </button>
                    <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white text-xs font-semibold px-6 py-2.5 rounded-xl transition shadow-sm">
                        حفظ التغييرات
                    </button>
                </div>
            </div>

            <!-- محتوى تبويب: الأمان وكلمة المرور -->
            <div x-show="activeTab === 'security'" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 lg:p-8 space-y-6" style="display: none;">
                <h2 class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-4">تغيير كلمة المرور</h2>
                
                <div class="space-y-4 text-xs max-w-xl">
                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">كلمة المرور الحالية</label>
                        <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">كلمة المرور الجديدة</label>
                        <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-semibold text-gray-700 block">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-gray-800 focus:outline-none focus:border-sky-500">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white text-xs font-semibold px-6 py-2.5 rounded-xl transition shadow-sm">
                        تحديث كلمة المرور
                    </button>
                </div>
            </div>

            <!-- محتوى تبويب: الإشعارات -->
            <div x-show="activeTab === 'notifications'" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 lg:p-8 space-y-6" style="display: none;">
                <h2 class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-4">تفضيلات الإشعارات</h2>
                
                <div class="space-y-4 text-xs">
                    <label class="flex items-center justify-between p-3 bg-gray-50/50 rounded-xl border border-gray-100 cursor-pointer">
                        <div>
                            <span class="font-bold text-gray-800 block">إشعارات الملخصات الجديدة</span>
                            <span class="text-[11px] text-gray-500">إرسال تنبيه عند إضافة ملخص جديد في موادك الدراسية</span>
                        </div>
                        <input type="checkbox" checked class="rounded border-gray-300 text-sky-600 focus:ring-sky-500 w-4 h-4">
                    </label>

                    <label class="flex items-center justify-between p-3 bg-gray-50/50 rounded-xl border border-gray-100 cursor-pointer">
                        <div>
                            <span class="font-bold text-gray-800 block">التعليقات والتفاعلات</span>
                            <span class="text-[11px] text-gray-500">تنبيهي عندما يقوم أحد بالتعليق على ملخصاتي</span>
                        </div>
                        <input type="checkbox" checked class="rounded border-gray-300 text-sky-600 focus:ring-sky-500 w-4 h-4">
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white text-xs font-semibold px-6 py-2.5 rounded-xl transition shadow-sm">
                        حفظ تفضيلات الإشعارات
                    </button>
                </div>
            </div>

            <!-- محتوى تبويب: المظهر -->
            <div x-show="activeTab === 'appearance'" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 lg:p-8 space-y-6" style="display: none;">
                <h2 class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-4">تخصيص المظهر</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="border-2 border-sky-500 bg-sky-50/30 p-4 rounded-2xl cursor-pointer space-y-2">
                        <div class="font-bold text-gray-900">الوضع الفاتح (افتراضي)</div>
                        <div class="text-[11px] text-gray-500">مظهر مريح للعين ومناسب للقراءة النهارية.</div>
                    </div>
                    <div class="border border-gray-200 hover:border-gray-300 p-4 rounded-2xl cursor-pointer space-y-2 opacity-60">
                        <div class="font-bold text-gray-900">الوضع الداكن (قريباً)</div>
                        <div class="text-[11px] text-gray-500">مناسب للاستخدام ليلاً وتوفير الطاقة.</div>
                    </div>
                </div>
            </div>

        </main>
@endsection