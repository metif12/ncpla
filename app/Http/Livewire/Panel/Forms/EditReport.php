<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\Report;
use App\Models\Shift;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditReport extends Component
{

    public Task $task;
    public Shift $shift;
    public Line $line;
    public Report $report;

    public string $description = '';

    public array $materials = [];
    public array $inputs = [];
    public array $outputs = [];

    public function mount(Report $report)
    {
        $this->report = $report;

        $this->task = $report->task;
        $this->shift = $report->shift;
        $this->line = $report->line;

        foreach ($report->materials as $material){

            $material->value = $material->pivot['value'];
            $this->materials[] = $material;
        }

        foreach ($report->inputs as $input){

            $input->product_id = $input->pivot['product_id'];
            $input->code = $input->pivot['code'];
            $this->inputs[] = $input;
        }

        foreach ($report->outputs as $output){

            $output->product_id = $output->pivot['product_id'];
            $output->input_id = $output->pivot['input_id'];
            $output->progress = $output->pivot['progress'];
            $output->code = $output->pivot['code'];
            $this->outputs[] = $output;
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

    public function confirm()
    {
        $this->report->confirms()->attach(Auth::id());
    }

    public function storeReport()
    {
        $this->validate();

        $this->report->update([

            'code' => generateCode(),

            'description' => $this->description,

            'user_id' => Auth::id(),
            'task_id' => $this->task->id,
            'line_id' => $this->task->line_id,
            'shift_id' => $this->shift->id,
        ]);

        $this->report->materials()->syncWithPivotValues([]);
        $this->report->inputs()->syncWithPivotValues([]);
        $this->report->outputs()->syncWithPivotValues([]);

        foreach ($this->materials as $material){

            $this->report->materials()->attach($material['id'],['value'=>$material['value']]);
        }

        foreach ($this->inputs as $input){

            $this->report->inputs()->attach($input['product_id'],['code'=>$input['code']]);
        }

        foreach ($this->outputs as $output){

            $this->report->outputs()->attach($output['product_id'],['code'=>$output['code'],'progress'=>$output['progress']]);
        }

        $this->redirectRoute('panel.reports');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-report')
            ->layout('panel.layout');
    }
}
