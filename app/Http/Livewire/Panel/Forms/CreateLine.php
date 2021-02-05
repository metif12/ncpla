<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\LineInputs;
use App\Models\LineMaterials;
use App\Models\LineOutputs;
use App\Models\Material;
use App\Models\Product;
use Livewire\Component;

class CreateLine extends Component
{
    public string $name = '';

    public array $materials = [];
    public array $inputs = [];
    public array $outputs = [];

    protected function getRules()
    {
        return [
            'name' => 'required|string|unique:lines,name',

            'materials.*' => 'required|integer',
            'inputs.*' => 'required|integer',
            'outputs.*' => 'required|integer',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function addMaterial()
    {
        $available = $this->getAvailableMaterialsQuery()->pluck('id');

        if ($available->isNotEmpty()) {

            $this->materials [] = $available[0];
        }
    }

    public function addOutput()
    {
        $available = $this->getAvailableOutputsQuery()->pluck('id');

        if ($available->isNotEmpty()) {

            $this->outputs [] = $available[0];
        }
    }

    public function addInput()
    {
        $available = $this->getAvailableInputsQuery()->pluck('id');

        if ($available->isNotEmpty()) {

            $this->inputs [] = $available[0];
        }
    }

    public function storeLine()
    {
        $this->validate();

        //todo check at least one (material||input)
        //todo check at least one output

        $line = Line::query()->create([

            'name' => $this->name,
            'code' => strtoupper(dechex(time())),
        ]);

        foreach ($this->materials as $material){

            LineMaterials::query()->create([

                'line_id' => $line->id,
                'material_id' => $material,
            ]);
        }

        foreach ($this->inputs as $input){

            LineInputs::query()->create([

                'line_id' => $line->id,
                'product_id' => $input,
            ]);
        }

        foreach ($this->outputs as $output){

            LineOutputs::query()->create([

                'line_id' => $line->id,
                'product_id' => $output,
            ]);
        }

        $this->redirectRoute('panel.lines');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-line', [

            'materials_list' => Material::all(),
            'product_list' => Product::all(),
        ])
            ->layout('panel.layout');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getAvailableMaterialsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Material::query()->whereNotIn('id', $this->materials);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getAvailableInputsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Product::query()->whereNotIn('id', $this->inputs)->whereNotIn('id', $this->outputs);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getAvailableOutputsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Product::query()->whereNotIn('id', $this->outputs)->whereNotIn('id', $this->inputs);
    }
}
