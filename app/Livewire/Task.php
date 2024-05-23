<?php

namespace App\Livewire;

use App\Models\Task as ModelsTask;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Task extends Component
{
    public function completed($id)
    {
        session()->flash('message', 'Task Completed Successfully.');
        ModelsTask::find($id)->update(['status' => 'Completed']);
    }

    public function delete($id)
    {
        ModelsTask::find($id)->delete();
        session()->flash('message', 'Task Deleted Successfully.');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.task', [
            'tasks' => ModelsTask::orderBy('id', 'DESC')->get()
        ]);
    }
}
