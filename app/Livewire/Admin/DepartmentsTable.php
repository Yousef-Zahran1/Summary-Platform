<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Department;
use Livewire\Attributes\On;

class DepartmentsTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true, except: 'latest')]
    public $sort = 'latest';

    #[Url(history: true, except: 'all')]
    public $tab = 'all';

    public function updatedSearch()     { $this->resetPage(); }
    public function updatedSort()       { $this->resetPage(); }

    public function changeTab($tab)
    {
        $this->tab = $tab;

        $this->sort = 'latest';
        $this->search = '';

        $this->resetPage();
    }


    #[On('deleteDepartment')]
    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);

        if ($department->subjects()->count() > 0) {
            $this->dispatch('notify', message: 'لا يمكن حذف القسم لأنه يحتوي على مواد دراسية.', type: 'error');
            return;
        }

        $department->delete();

        $this->resetPage();
        $this->dispatch('notify', message: 'تم حذف القسم بنجاح', type: 'success');
    }

    public function render()
    {
        // ======== Base Query ========
        $base = Department::withCount(['subjects'])
            ->withCount(['summaries']);

        $query = match ($this->tab) {
            'with'  => $base->has('subjects'),
            'empty' => $base->doesntHave('subjects'),
            default => $base, // all
        };

        // ======== Filters ========
        $query
            ->when($this->sort, function ($q) {
                if ($this->sort === 'latest') {
                    $q->latest();
                } elseif ($this->sort === 'oldest') {
                    $q->oldest();
                } elseif ($this->sort === 'name_asc') {
                    $q->orderBy('name', 'asc');
                } elseif ($this->sort === 'name_desc') {
                    $q->orderBy('name', 'desc');
                } elseif ($this->sort === 'subjects_desc') {
                    $q->orderByDesc('subjects_count');
                }
            })
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                });
            });

        $departments = $query->paginate(20);

        // ======== Counts ========
        $allDepartments        = Department::count();
        $withSubjects          = Department::has('subjects')->count();
        $emptyDepartments      = Department::doesntHave('subjects')->count();
        $totalSubjectsCount    = \App\Models\Subject::count();

        return view('livewire.admin.departments-table', [
            'departments'        => $departments,
            'allDepartments'     => $allDepartments,
            'withSubjects'       => $withSubjects,
            'emptyDepartments'   => $emptyDepartments,
            'totalSubjectsCount' => $totalSubjectsCount,
        ]);
    }
}