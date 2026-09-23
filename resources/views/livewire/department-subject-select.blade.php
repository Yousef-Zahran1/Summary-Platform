<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <!-- القسم الدراسي -->
    <div class="space-y-1.5">
        <label for="department_id" class="text-xs font-bold text-slate-600">القسم الدراسي</label>
        <select wire:model.live="departmentId" id="department_id" name="department_id" required
                class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
            <option value="">اختر القسم</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select>
    </div>

    <!-- المادة الدراسية -->
    <div class="space-y-1.5">
        <label for="subject_id" class="text-xs font-bold text-slate-600">المادة الدراسية</label>
        <select wire:model="subjectId" id="subject_id" name="subject_id" required @disabled(!$departmentId)
                class="w-full rounded-xl border border-slate-200 py-2.5 px-4 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
                <option value="" >
                    {{ $departmentId ? 'اختر المادة' : 'اختر القسم أولاً' }}
                </option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>
</div>