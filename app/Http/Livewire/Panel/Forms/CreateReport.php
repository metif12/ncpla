<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\LineAttributes;
use App\Models\Report;
use App\Models\Shift;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateReport extends Component
{

    public Task $task;
    public Shift $shift;

    public string $description = '';

    public array $materials = [];
    public array $inputs = [];
    public array $outputs = [];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->shift = Auth::user()->shift;

        foreach ($task->line->materials as $material) {

            $material['value'] = '';
            $this->materials[] = $material;
        }
    }

    protected function getRules(): array
    {
        return [
            'description' => 'nullable|string',
            'inputs.*.product_id' => 'required|integer',
            'inputs.*.code' => 'required|string',

            'outputs.*.product_id' => 'nullable|integer',
            'outputs.*.code' => 'required|string',
            'outputs.*.progress' => 'required|regex:/^\d+(\.\d+)?$/',

            'materials.*.value' => 'required|regex:/^\d+(\.\d+)?$/',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function remInput($i)
    {
        array_splice($this->inputs, $i, 1);
    }

    public function remOutput($i)
    {
        array_splice($this->outputs, $i, 1);
    }

    public function addInput()
    {
        if ($this->task->line->inputs->count() > 0)
            $this->inputs[] = [

                'product_id' => '',
                'code' => '',
            ];
    }

    public function addOutput()
    {

        $this->outputs[] = [

            'product_id' => $this->task->line->product_id,
            'input_id' => null,
            'code' => generateCode(),
            'progress' => 1.00,
        ];
    }

    public function storeReport()
    {
        $this->validate();

        $report = Report::query()->create([

            'code' => generateCode(),

            'description' => $this->description,

            'user_id' => Auth::id(),
            'task_id' => $this->task->id,
            'line_id' => $this->task->line_id,
            'shift_id' => $this->shift->id,
        ]);

        foreach ($this->materials as $material){

            $report->materials()->attach($material['id'],['value'=>$material['value']]);
        }

        foreach ($this->inputs as $input){

            $report->inputs()->attach($input['product_id'],['code'=>$input['code']]);
        }

        foreach ($this->outputs as $output){

            $report->outputs()->attach($output['product_id'],['code'=>$output['code'],'progress'=>$output['progress']]);
        }

        $this->redirectRoute('panel.reports');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-report')
            ->layout('panel.layout');
    }
}
