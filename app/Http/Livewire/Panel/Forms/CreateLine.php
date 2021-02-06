<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\LineAttributes;
use App\Models\LineInputs;
use App\Models\LineMaterials;
use App\Models\LineOutputs;
use App\Models\Material;
use App\Models\Product;
use Livewire\Component;

class CreateLine extends Component
{
    public string $name = '';
    public int $output = 0;

    public array $materials = [];
    public array $inputs = [];

    public array $attrs = [];

    protected function getRules()
    {
        return [
            'name' => 'required|string|unique:lines,name',
            'output' => 'required|integer',

            'materials.*' => 'required|integer',
            'inputs.*' => 'required|integer',

            'attrs.*.name' => 'required|string',
            'attrs.*.type' => 'required|string',
            'attrs.*.default' => 'nullable',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function addAttr()
    {
        $this->attrs [] = [

            'name' => '',
            'type' => Line::$types[0]['value'],
            'unit' => '',
            'default' => '',
            'merge_type' => Line::$merge_types[0]['value'],

        ];
    }

    public function remAttr($i)
    {
        array_splice($this->attrs, $i,1);
    }

    public function addMaterial()
    {
        $available = $this->getAvailableMaterialsQuery()->pluck('id');

        if ($available->isNotEmpty()) {

            $this->materials [] = $available[0];
        }
    }

    public function remMaterial($i)
    {
        array_splice($this->materials, $i,1);
    }

    public function addInput()
    {
        $available = $this->getAvailableInputsQuery()->pluck('id');

        if ($available->isNotEmpty()) {

            $this->inputs [] = $available[0];
        }
    }

    public function remIntput($i)
    {
        array_splice($this->inputs, $i,1);
    }

    public function storeLine()
    {
        $this->validate();

        //todo check at least one (material||input)
        //todo check at least one output

        $line = Line::query()->create([

            'name' => $this->name,
            'code' => generateCode(),

            'product_id' => $this->output,
        ]);

        $line->inputs()->sync($this->inputs);
        $line->materials()->sync($this->materials);

        foreach ($this->attrs as $attr){

            $attr['product_id'] = $line->id;
            LineAttributes::query()->create($attr);
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
        return Product::query()->whereNotIn('id', $this->inputs)->where('id', '<>', $this->output);
    }
}
