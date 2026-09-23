<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\Subject;

class DepartmentSubjectSelect extends Component
{
    public $departmentId;
    public $departments;
    public $subjects = [];
    public $subjectId;
    public function mount($department_id = null , $subject_id = null){
        $this->departmentId = $department_id;
        $this->subjectId = $subject_id;

        $this->departments = Department::all();

        $this->subjects = Subject::where(
            'department_id',
            $this->departmentId
        )->get();
    }
    public function updatedDepartmentId($departmentId){
        $this->subjectId = null;
        $this->subjects = Subject::where('department_id', $departmentId )->get();
    }
    public function render()
    {
        return view('livewire.department-subject-select');
    }
}
