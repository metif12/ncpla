<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\Task;
use App\Models\TaskAttribute;
use Livewire\Component;
use Livewire\WithPagination;

class EditTask extends Component
{

    public Line $line;
    public Task $task;

    public array $attrs = [];
//    public array $pattrs = [];

    public function mount(Task $task)
    {
        $this->line = $task->line;
        $this->task = $task;

        $this->attrs = $task->task_attributes->toArray() ?? [];
    }

    protected function getRules()
    {
        $rules = [];

        foreach ($this->attrs ?? [] as $i => $attr) {

            switch ($attr['type']){

                case 'text' :
                    $rules["attrs.$i.value"] = "required|string";
                    break;

                case 'number' :
                    $rules["attrs.$i.value"] = "required|regex:/^\d+(\.\d+)?$/";
                    break;

            }

        }

        return $rules;
    }

    public function updated()
    {
        $this->validate();
    }

    public function updateTask()
    {
        $this->validate();

        $names = [];

        foreach ($this->attrs as $attr){

            TaskAttribute::query()->updateOrCreate(
                [
                    'task_id' => $this->task->id,
                    'line_id' => $this->line->id,
                    'name' => $attr['name'],
                ],
                [
                    'type' => $attr['type'],
                    'merge_type' => $attr['merge_type'],
                    'default' => $attr['default'],
                    'unit' => $attr['unit'],
                ]
            );

            $names[] = $attr['name'];
        }

        TaskAttribute::query()
            ->where('task_id' , $this->task->id)
            ->where('line_id' , $this->line->id)
            ->whereNotIn('name' , $names)
            ->delete();

        $this->redirectRoute('panel.tasks');
    }

    public function render()
    {

        return view('livewire.panel.forms.edit-task',[

        ])
        ->layout('panel.layout');

    }
}
