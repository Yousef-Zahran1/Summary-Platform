<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\BasicDepartment;
use Livewire\Attributes\On;

class UsersTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $department = '';

    #[Url(history: true)]
    public $level = '';

    #[Url(history: true, except: 'latest')]
    public $sort = "latest";

    #[Url(history: true, except: 'students')]
    public $tab = "students";

    public function updatedSort()      { $this->resetPage(); }
    public function updatedSearch()    { $this->resetPage(); }
    public function updatedLevel()     { $this->resetPage(); }

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
        $this->level = '';

        $this->resetPage();
    }


    #[On('banUser')]
    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_banned' => true]);

        $this->resetPage();

        $this->dispatch('notify', type: 'success', message: 'تم حظر المستخدم بنجاح .');
    }

    #[On('unbanUser')]
    public function unbanUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_banned' => false]);

        $this->resetPage();

        $this->dispatch('notify', type: 'success', message: 'تم فك حظر المستخدم بنجاح .');
    }

    #[On('restoreUser')]
    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        $this->resetPage();

        $this->dispatch('notify', type: 'success', message: 'تم استرجاع ملف هذا المستخدم بنجاح .');
    }

    #[On('deleteUser')]
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        $this->resetPage();

        $this->dispatch('notify', type: 'success', message: 'تم حذف المستخدم بنجاح .');
    }

    public function render()
    {
        $base = User::with(['basic_department', 'summaries']);

        $query = match ($this->tab) {
            'admins'  => $base->where('role', 'admin'),
            'deleted' => $base->onlyTrashed(),
            'banned'  => $base->where('role', 'student')->where('is_banned', true),
            default   => $base->where('role', 'student')->where('is_banned', false), // students
        };

        $query
            ->when($this->department, function ($q) {
                if ($this->department === 'undefined') {
                    $q->whereNull('basic_department_id');
                } else {
                    $q->where('basic_department_id', $this->department);
                }
            })
            ->when($this->level, function ($q) {
                if ($this->level === 'undefined') {
                    $q->whereNull('level');
                } else {
                    $q->where('level', $this->level);
                }
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
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            });

        $users = $query->paginate(20);

        $allUsers          = User::count();
        $adminsCount       = User::where('role', 'admin')->count();
        $studentsCount     = User::where('role', 'student')->where('is_banned', false)->count();
        $deletedUsersCount = User::onlyTrashed()->count();
        $bannedUsersCount  = User::where('role', 'student')->where('is_banned', true)->count();

        $basicDepartments = BasicDepartment::all();

        return view('livewire.admin.users-table', [
            'users'             => $users,
            'allUsers'          => $allUsers,
            'adminsCount'       => $adminsCount,
            'studentsCount'     => $studentsCount,
            'deletedUsersCount' => $deletedUsersCount,
            'bannedUsersCount'  => $bannedUsersCount,
            'basicDepartments'  => $basicDepartments,
        ]);
    }
}