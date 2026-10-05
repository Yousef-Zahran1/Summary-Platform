@props([
    'summary',
    'variant' => 'normal',
    'isPending' => false,
    'isTrashed' => false,
    'isRejected' => false,   
])
@if ($variant == 'small')
    <div
        class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition group">

        <div>
            <a href="{{ route('summaries.show', $summary->id) }}"
                class="relative h-33 border-b w-full bg-slate-50 border-slate-100 block overflow-hidden">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80"
                    alt="{{ $summary->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div
                    class="absolute top-3 right-3 bg-blue-100 text-blue-700 text-[8px] font-bold px-2 py-1 rounded-lg flex items-center gap-1">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    {{ $summary->subject->name }}
                </div>
            </a>

            <div class="p-4">
                <a href="{{ route('summaries.show', $summary->id) }}" class="border-slate-100 block overflow-hidden">
                    <h3 class="font-bold text-slate-900 text-[12px] mb-3 line-clamp-1 hover:text-blue-600 transition">
                        {{ $summary['title'] }}</h3>
                </a>
                <div class="flex items-center justify-between text-[9px] text-slate-500">
                    <div class="flex items-center gap-2">
                        <span class="flex items-center gap-1.5 font-semibold text-slate-700">
                            <a href="{{ route('profile.show', $summary->user_id) }}"
                                class="w-5 h-5 p-[1px] rounded-[50%] bg-slate-100 flex items-center justify-center border border-slate-200 overflow-hidden relative">
                                <svg class="w-full h-full text-slate-400" viewBox="0 0 24 24" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </a>
                            <a
                                href="{{ route('profile.show', $summary->user_id) }}">{{ $summary->user->name ?? 'غير محدد' }}</a>
                        </span>
                        <span class="text-slate-300">|</span>
                        <span class="flex items-center gap-1 text-slate-600 font-medium">
                            <svg class="w-3 h-3 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            {{ $summary->downloads_count }} تنزيل
                        </span>
                    </div>
                    <span>{{ $summary->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <div class="px-3 pb-2 pt-2 flex items-center justify-between border-t border-slate-100 mt-auto text-slate-500">
            <div
                class="flex items-center {{ $summary->user_id == auth()->id() ? '' : 'justify-around' }} gap-1 flex-1">
                <livewire:like-button :summary="$summary" wire:key="summary-like-{{ $summary->id }}" />
                <livewire:save-button :summary="$summary" wire:key="summary-save-{{ $summary->id }}" />
                <button
                    class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition"
                    title="مشاركة">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="18" cy="5" r="3"></circle>
                        <circle cx="6" cy="12" r="3"></circle>
                        <circle cx="18" cy="19" r="3"></circle>
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                    </svg>
                    <span class="text-[9px] font-bold mt-0.5">مشاركة</span>
                </button>
            </div>
            @if ($summary->user_id == auth()->id())
                <div class="flex items-center gap-1 font-bold">
                    <form action="{{ route('summaries.destroy', $summary->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الملخص؟')"
                            class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-red-50 hover:text-red-500 transition"
                            title="حذف">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            <span class="text-[9px] font-bold mt-0.5">حذف</span>
                        </button>
                    </form>
                    <a href="{{ route('summaries.edit', $summary->id) }}"
                        class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition"
                        title="تعديل">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                        <span class="text-[9px] font-bold mt-0.5">تعديل</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="relative">
        <div
            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition group ">

            <div>
                <a href="{{ route('summaries.show', $summary->id) }}"
                    class="relative h-44 border-b w-full bg-slate-50 border-slate-100 block overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80"
                        alt="{{ $summary->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    <div
                        class="absolute top-3 right-3 bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-1 rounded-lg flex items-center gap-1">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{ $summary->subject->name }}
                    </div>
                </a>

                <div class="p-4">
                    <a href="{{ route('summaries.show', $summary->id) }}"
                        class="border-slate-100 block overflow-hidden">
                        <h3 class="font-bold text-slate-900 text-sm mb-3 line-clamp-1 hover:text-blue-600 transition">
                            {{ $summary['title'] }}</h3>
                    </a>
                    <div class="flex items-center justify-between text-[11px] text-slate-500">
                        <div class="flex items-center gap-2">
                            <span class="flex items-center gap-1.5 font-semibold text-slate-700">
                                <a href="{{ route('profile.show', $summary->user_id) }}"
                                    class="w-6 h-6 rounded-[50%] bg-slate-100 flex items-center justify-center border border-slate-200 overflow-hidden relative">
                                    @if ($summary->user->avatar)
                                        <img src="{{ asset('storage/' . $summary->user->avatar) }}"
                                            alt="{{ $summary->user->name }}"
                                            class="w-full h-full rounded-full object-cover">
                                    @else
                                        <svg class="w-full h-full text-slate-400" viewBox="0 0 24 24"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    @endif
                                </a>
                                <a
                                    href="{{ route('profile.show', $summary->user_id) }}">{{ $summary->user->name }}</a>
                            </span>
                            <span class="text-slate-300">|</span>
                            <span class="flex items-center gap-1 text-slate-600 font-medium">
                                <svg class="w-3 h-3 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                {{ $summary->downloads_count }} تنزيل
                            </span>
                        </div>
                        <span>{{ $summary->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <div class="px-3 pb-2 pt-2 flex items-center justify-between border-t border-slate-100 mt-auto text-slate-500">
                @if (!$isPending && !$isTrashed  && !$isRejected)
                    <div class="flex items-center {{ $summary->user_id == auth()->id() ? '' : 'justify-around' }} gap-1 flex-1">
                        <livewire:like-button :summary="$summary" wire:key="summary-like-{{ $summary->id }}" />
                        <livewire:save-button :summary="$summary" wire:key="summary-save-{{ $summary->id }}" />

                        <div x-data="{ copied: false }">
                            <button
                                @click="
                                    if (navigator.share) {
                                        navigator.share({
                                            title: '{{ $summary->title }}',
                                            text: 'شاهد هذا الملخص الرائع على منصة ملخصات كلية العلوم',
                                            url: '{{ route('summaries.show', $summary->id) }}',
                                        }).catch(() => {});
                                    } else {
                                        navigator.clipboard.writeText('{{ route('summaries.show', $summary->id) }}');
                                        copied = true;
                                        setTimeout(() => copied = false, 2000);
                                    }
                                "
                                class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition relative cursor-pointer"
                                title="مشاركة">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="18" cy="5" r="3"></circle>
                                    <circle cx="6" cy="12" r="3"></circle>
                                    <circle cx="18" cy="19" r="3"></circle>
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5"
                                    x-text="copied ? 'تم النسخ!' : 'مشاركة'">مشاركة</span>
                            </button>
                        </div>
                    </div>
                @endif
                @if ($summary->user_id == auth()->id())
                    <div class="flex items-center gap-1 font-bold">
                        <form action="{{ route('summaries.destroy', $summary->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الملخص؟')"
                                class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-red-50 hover:text-red-500 transition"
                                title="حذف">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">حذف</span>
                            </button>
                        </form>
                        @if($isTrashed)
                            <a class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-green-100 hover:text-green-700 transition"
                                title="استرجاع">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                    <polyline points="1 4 1 10 7 10"></polyline>
                                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">استرجاع</span>
                            </a>
                        @elseif($isRejected)
                            
                        @else
                            <a href="{{ route('summaries.edit', $summary->id) }}"
                                class="flex flex-col items-center justify-center px-2.5 py-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition"
                                title="تعديل">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                                <span class="text-[9px] font-bold mt-0.5">تعديل</span>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>
@endif
