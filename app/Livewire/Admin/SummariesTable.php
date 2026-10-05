<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Summary;
use App\Models\Subject;
use App\Models\Department;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class SummariesTable extends Component
{
    use WithPagination;


    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $department = '';

    #[Url(history: true)]
    public $subject ;

    #[Url(history: true , except: 'latest')]
    public $sort = "latest";

    #[Url(history: true , except: 'uploadedSummaries')]
    public $tab = "uploadedSummaries";

    public $acceptedSummary;


    public function updatedSort(){
        $this->resetPage();
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedDepartment()
    {
        $this->resetPage();
        $this->subject = null;
    }

    public function updatedSubject()
    {
        $this->resetPage();
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;

        $this->sort = 'latest';
        $this->search = '';
        $this->department = '';
        $this->subject = null;

        $this->resetPage();
    }

    public function acceptSummary($id)
    {
        $summary = Summary::findOrFail($id);

        $summary->update([
            'status' => 'accepted',
        ]);

        $this->resetPage();
        $this->dispatch('notify', type: 'success', message: 'تم قبول الملخص بنجاح.');
    }

    #[On('rejectSummary')]
    public function rejectSummary($id)
    {
        $summary = Summary::findOrFail($id);

        $summary->update([
            'status' => 'rejected',
        ]);

        $this->resetPage();
        $this->dispatch('notify', type: 'success', message: 'تم رفض الملخص بنجاح.');
    }


    public function returnSummary($id)
    {
        $summary = Summary::findOrFail($id);

        $summary->update([
            'status' => 'pending',
        ]);

        $this->resetPage();
        $this->dispatch('notify', type: 'success', message: 'تم إعادة الملخص لوضع قيد الإنتظار.');
    }

    #[On('deleteSummary')]
    public function deleteSummary($id)
    {
        $summary = Summary::findOrFail($id);

        $summary->delete();

        $this->resetPage();
        $this->dispatch('notify', type: 'success', message: 'تم حذف الملخص بنجاح.');
    }

    public function restoreSummary($id)
    {
        $summary = Summary::onlyTrashed()->findOrFail($id);

        $summary->restore();

        $this->resetPage();
        $this->dispatch('notify', type: 'success', message: 'تم إستعادة الملخص بنجاح.');
    }

    public function render()
    {

        $firstSummaries = Summary::with('user', 'subject', 'subject.department');

        $query = match($this->tab){
            'uploadedSummaries'=> $firstSummaries->where('status' , 'accepted'),
            'uploadedRequests' => $firstSummaries->where('status' , 'pending'),
            'uploadedRejected' => $firstSummaries->where('status' , 'rejected'),
            'deletedSummaries' => $firstSummaries->onlyTrashed()->where('deleted_by', auth()->id()),
            default => $firstSummaries->where('status', 'accepted'),
        };
        
        $query->when($this->department , function($q){
            $q->whereHas('subject' , function($query){
                $query->where('department_id' , $this->department);
            });
        })
        ->when($this->subject , function($q){
            $q->where('subject_id', $this->subject);
        })
        ->when($this->sort , function($q){
            if($this->sort === 'latest'){
                $q->latest();
            } elseif ($this->sort === 'oldest'){
                $q->oldest();
            } elseif ($this->sort === 'name_asc') {
                $q->orderBy('title', 'asc');
            } elseif ($this->sort === 'name_desc') {
                $q->orderBy('title', 'desc');
            }
        })
        ->when($this->search , function($query){
            $query->where(function ($query){
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhereHas('subject', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%")
                            ->orWhere('code', 'like', "%{$this->search}%");
                    })
                    ->orWhereHas('subject.department', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    });
            });
        });

        $summaries = $query->paginate(20);
        $subjects = Subject::when($this->department, function ($q) {
            $q->where('department_id', $this->department);
        })->get();
        $acceptedCount=Summary::where('status' , 'accepted' )->count();
        $pendingCount=Summary::where('status' , 'pending' )->count();
        $rejectedCount=Summary::where('status' , 'rejected' )->count();
        $deletedCount=Summary::onlyTrashed()->where('deleted_by', auth()->id())->count();
        $departments = Department::all();
        return view('livewire.admin.summaries-table' , compact('summaries' ,'acceptedCount', 'pendingCount', 'rejectedCount' , 'deletedCount' , 'subjects' ,'departments'));
    }
}
