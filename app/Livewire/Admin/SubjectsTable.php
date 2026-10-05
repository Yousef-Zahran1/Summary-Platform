<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subject;
use App\Models\Department;
use Livewire\Attributes\On;

class SubjectsTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $department = '';

    #[Url(history: true, except: 'latest')]
    public $sort = 'latest';


    #[Url(history: true, except: 'all')]
    public $tab = 'all';

    public function updatedSearch()     { $this->resetPage(); }
    public function updatedSort()       { $this->resetPage(); }

    public function updatedDepartment()
    {
        $this->resetPage();
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;

        $this->sort = 'latest';
        $this->search = '';
        $this->department = '';

        $this->resetPage();
    }


    #[On('deleteSubject')]
    public function deleteSubject($id)
    {
        $subject = Subject::withCount('summaries')->findOrFail($id);

        if ($subject->summaries_count > 0) {
            $this->dispatch('notify', type: 'error', message: 'لا يمكن حذف المادة لاحتوائها على ملخصات.');
            return;
        }

        $subject->delete();
        $this->resetPage();

        $this->dispatch('notify', type: 'success', message: 'تم حذف المادة بنجاح.');
    }
    public function render()
    {
        // ======== Base Query ========
        $base = Subject::with('department')->withCount('summaries');

        $query = match ($this->tab) {
            'with'  => $base->has('summaries'),
            'empty' => $base->doesntHave('summaries'),
            default => $base, // all
        };

        $query
            ->when($this->department, function ($q) {
                $q->where('department_id', $this->department);
            })
            ->when($this->sort, function ($q) {
                if ($this->sort === 'latest') {
                    $q->latest();
                } elseif ($this->sort === 'oldest') {
                    $q->oldest();
                } elseif ($this->sort === 'name_asc') {
                    $q->orderBy('name', 'asc');
                } elseif ($this->sort === 'name_desc') {
                    $q->orderBy('name', 'desc');
                }
            })
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', "%{$this->search}%")
                        ->orWhere('code', 'like', "%{$this->search}%");
                });
            });

        $subjects = $query->paginate(20);

        $allSubjects      = Subject::count();
        $withSummaries    = Subject::has('summaries')->count();
        $emptySubjects    = Subject::doesntHave('summaries')->count();
        $departmentsCount = Department::count();

        $departments = Department::all();

        return view('livewire.admin.subjects-table', [
            'subjects'         => $subjects,
            'departments'      => $departments,
            'allSubjects'      => $allSubjects,
            'withSummaries'    => $withSummaries,
            'emptySubjects'    => $emptySubjects,
            'departmentsCount' => $departmentsCount,
        ]);
    }
}