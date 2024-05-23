<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TaskCreate extends Component
{
    public $title;
    public $priority;

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'priority' => 'required',
        ]);

        Task::create([
            'title' => $this->title,
            'priority' => $this->priority,
        ]);

        session()->flash('message', 'Task Created Successfully.');
        return $this->redirectRoute('task', navigate: true);

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.task-create');
    }
}
