<div>
    @if ($show)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4" x-data x-init="$nextTick(() => $el.querySelector('button')?.focus())"
            @keydown.escape.window="$wire.close()">

            {{-- الخلفية المعتمة --}}
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" wire:click="close"></div>

            {{-- صندوق الرسالة --}}
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

                {{-- الرأس --}}
                <div class="flex items-center gap-3 p-5 border-b border-slate-100">
                    <div class="w-11 h-11 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                            </path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-900 text-base">{{ $title }}</h3>
                    </div>
                    <button wire:click="close" type="button"
                        class="text-slate-400 hover:text-slate-600 transition p-1 rounded-lg hover:bg-slate-100">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                {{-- المحتوى --}}
                <div class="p-5">
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $message }}</p>
                </div>

                {{-- الأزرار --}}
                <div class="flex items-center justify-end gap-2 p-4 bg-slate-50 border-t border-slate-100">
                    <button wire:click="close" type="button"
                        class="px-4 py-2 text-sm font-bold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 transition">
                        {{ $cancelText }}
                    </button>

                    <button wire:click="confirm" type="button" wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-bold rounded-xl bg-red-600 hover:bg-red-700 text-white transition shadow-sm disabled:opacity-60">
                        <span wire:loading.remove wire:target="confirm">{{ $confirmText }}</span>
                        <span wire:loading wire:target="confirm">جاري التنفيذ...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
