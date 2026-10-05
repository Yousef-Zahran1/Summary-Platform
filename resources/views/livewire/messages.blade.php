<div class="fixed bottom-6 right-6 z-50 max-w-md w-full space-y-2">

    {{-- الأخطاء من الـ validation --}}
    @if ($errors->any())
        <div wire:key="errors-box"
            class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl shadow-xl">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span class="text-xs sm:text-sm font-bold">راجع البيانات دي:</span>
                </div>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- الرسائل من الـ event 'notify' --}}
    @foreach ($messages as $msg)
        <div wire:key="msg-{{ $msg['id'] }}" x-data="{ show: false }" x-init="$nextTick(() => show = true);
        setTimeout(() => { show = false;
            setTimeout(() => $wire.remove('{{ $msg['id'] }}'), 300) }, 4000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="px-5 py-4 rounded-2xl flex items-center justify-between shadow-xl
                    {{ $msg['type'] === 'success' ? 'bg-emerald-50 border border-emerald-200 text-emerald-800' : '' }}
                    {{ $msg['type'] === 'error' ? 'bg-rose-50 border border-rose-200 text-rose-800' : '' }}
                    {{ $msg['type'] === 'info' ? 'bg-blue-50 border border-blue-200 text-blue-800' : '' }}">

            <div class="flex items-center gap-3">
                @if ($msg['type'] === 'success')
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                @elseif($msg['type'] === 'error')
                    <svg class="w-5 h-5 text-rose-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                @endif
                <span class="text-xs sm:text-sm font-bold">{{ $msg['text'] }}</span>
            </div>

            <button wire:click="remove('{{ $msg['id'] }}')" class="opacity-70 hover:opacity-100 transition">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
    @endforeach

    {{-- رسائل الـ session العادية --}}
    @if (session('success'))
        <div wire:key="session-success" x-data="{ show: false }" x-init="$nextTick(() => show = true);
        setTimeout(() => { show = false;
            setTimeout(() => $el.remove(), 300) }, 4000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl flex items-center justify-between shadow-xl">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span class="text-xs sm:text-sm font-bold">{{ session('success') }}</span>
            </div>
        </div>
    @endif
</div>
