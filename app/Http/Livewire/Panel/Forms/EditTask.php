<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\Material;
use App\Models\Task;
use App\Models\TaskAttribute;
use App\Models\TaskMaterial;
use Livewire\Component;
use Livewire\WithPagination;

class EditTask extends Component
{

    public Line $line;
    public Task $task;

    public array $attrs = [];
    public array $mattrs = [];

    public function mount(Task $task)
    {
        $this->line = $task->line;
        $this->task = $task;

        $this->attrs = $task->task_attributes->toArray() ?? [];
        $this->mattrs = $task->task_materials->toArray() ?? [];

        foreach ($this->mattrs as $i => $mattr){

            $this->mattrs[$i]['material'] = Material::find($mattr['material_id'])['name'];
        }
    }

    protected function getRules()
    {
        $rules = [

            'line' => 'required'
        ];

        foreach ($this->attrs ?? [] as $i => $attr) {

            $rules["attrs.$i.description"] = 'nullable|string';

            switch ($attr['type']){

                case 'text' :
                    $rules["attrs.$i.value"] = "required|string";
                    break;

                case 'number' :
                    $rules["attrs.$i.value"] = "required|regex:/^\d+(\.\d+)?$/";
                    break;

            }
        }

        foreach ($this->mattrs ?? [] as $i => $attr) {

            $rules["mattrs.$i.description"] = 'nullable|string';

            switch ($attr['type']){

                case 'text' :
                    $rules["mattrs.$i.value"] = "required|string";
                    break;

                case 'number' :
                    $rules["mattrs.$i.value"] = "required|regex:/^\d+(\.\d+)?$/";
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

        TaskAttribute::query()
            ->where('task_id' , $this->task->id)
            ->where('line_id' , $this->line->id)
            ->delete();

        foreach ($this->attrs as $attr){

            TaskAttribute::query()->create(
                [
                    'task_id' => $this->task->id,
                    'line_id' => $this->line->id,
                    'name' => $attr['name'],
                    'type' => $attr['type'],
                    'value' => $attr['value'],
                    'merge_type' => $attr['merge_type'],
                    'unit' => $attr['unit'],
                ]
            );
        }

        TaskMaterial::query()
            ->where('task_id' , $this->task->id)
            ->where('line_id' , $this->line->id)
            ->delete();

        foreach ($this->mattrs as $attr){

            TaskMaterial::query()->create(
                [
                    'task_id' => $this->task->id,
                    'line_id' => $this->line->id,
                    'material_id' => $attr['material_id'],
                    'name' => $attr['name'],
                    'type' => $attr['type'],
                    'merge_type' => $attr['merge_type'],
                    'value' => $attr['value'],
                    'unit' => $attr['unit'],
                ]
            );
        }

        $this->redirectRoute('panel.tasks');
    }

    public function render()
    {

        return view('livewire.panel.forms.edit-task',[

        ])
        ->layout('panel.layout');

    }
}
