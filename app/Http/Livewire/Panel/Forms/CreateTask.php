<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\Task;
use App\Models\TaskAttribute;
use App\Models\TaskMaterial;
use Livewire\Component;
use Livewire\WithPagination;

class CreateTask extends Component
{

    public Line $line;

    public array $attrs = [];

    public array $mattrs = [];

    public function mount(Line $line)
    {
        $this->line = $line;

        foreach ($this->line->line_attributes ?? [] as $attr) {

            $attr['value'] = $attr['default'];
            $attr['description'] = '';

            $this->attrs[$this->line->id] = $attr;
        }

        foreach ($this->line->materials ?? [] as $material) {
            foreach ($material->material_attributes ?? [] as $attr) {

                $attr['value'] = $attr['default'];
                $attr['material'] = $material['name'];

                $this->mattrs[$material->id] = $attr;
            }
        }
    }

    protected function getRules()
    {
        $rules = [

            'line' => 'required'
        ];

        foreach ($this->attrs ?? [] as $i => $attr) {

            $rules["attrs.$i.description"] = 'nullable|string';

            switch ($attr['type']) {

                case 'text' :
                    $rules["attrs.$i.value"] = "required|string";
                    break;

                case 'number' :
                    $rules["attrs.$i.value"] = "required|regex:/^\d+(\.\d+)?$/";
                    break;

            }

        }

        foreach ($this->mattrs ?? [] as $i => $attr) {

            switch ($attr['type']) {

                case 'text' :
                    $rules["mattrs.*.value"] = "required|string";
                    break;

                case 'number' :
                    $rules["mattrs.*.value"] = "required|regex:/^\d+(\.\d+)?$/";
                    break;

            }
        }

        return $rules;
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeTask()
    {
        $this->validate();

        $task = Task::query()->create([

            'code' => generateCode(),
            'line_id' => $this->line->id,
        ]);

        foreach ($this->attrs as $attr) {

            $attr['task_id'] = $task->id;
            $attr['line_id'] = $this->line->id;

            TaskAttribute::query()->create($attr);
        }

        foreach ($this->mattrs as $attr) {

            $attr['task_id'] = $task->id;
            $attr['line_id'] = $this->line->id;

            TaskMaterial::query()->create($attr);
        }

        $this->redirectRoute('panel.tasks');
    }

    public function render()
    {

        return view('livewire.panel.forms.create-task', [

        ])
            ->layout('panel.layout');

    }
}
