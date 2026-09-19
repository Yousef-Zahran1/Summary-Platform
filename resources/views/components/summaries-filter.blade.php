@props(['route'])
<form method="GET" action="{{ $route }}" class="relative w-full sm:w-auto">
    <select name="sort" onchange="this.form.submit()" class="appearance-none bg-white border border-slate-200 text-slate-800 text-xs rounded-xl px-4 py-2.5 
                    pl-10 focus:outline-none focus:border-blue-500 transition font-medium w-full sm:w-44 cursor-pointer">
        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>الأحدث</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم</option>
        <option value="highest_likes" {{ request('sort') == 'highest_likes' ? 'selected' : '' }}>الأعلى إعجاباً</option>
        <option value="highest_downloads" {{ request('sort') == 'highest_downloads' ? 'selected' : '' }}>الأعلى تنزيلاً</option>
    </select>
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 gap-1">
        <!-- أيقونة Chevron Down -->
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
    
    </div>
</form>