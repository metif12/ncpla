<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use App\Models\LineInputs;
use App\Models\LineMaterials;
use App\Models\LineOutputs;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditLine extends Component
{
    public Line $line;

    public string $name = '';

    public array $materials = [];
    public array $inputs = [];
    public array $outputs = [];

    public function mount(Line $line)
    {
        $this->line = $line;
        $this->name = $line->name;

        $this->materials = $line->materials()->pluck('material_id')->toArray();
        $this->inputs = $line->inputs()->pluck('product_id')->toArray();
        $this->outputs = $line->outputs()->pluck('product_id')->toArray();
    }

    protected function getRules()
    {
        return [
            'name' => ['required', 'string', Rule::unique('lines','name')->ignore($this->line?->id ?? 0)],

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

        $this->line->update([

            'name' => $this->name,
        ]);

        foreach ($this->materials as $material) {

            LineMaterials::query()->updateOrCreate(
                [
                    'line_id' => $this->line->id,
                    'material_id' => $material,
                ]
            );
        }

        LineMaterials::query()
            ->where('line_id', $this->line->id,)
            ->whereNotIn('material_id', $this->materials)
            ->delete();

        foreach ($this->inputs as $input) {

            LineInputs::query()->updateOrCreate([

                'line_id' => $this->line->id,
                'product_id' => $input,
            ]);
        }

        LineInputs::query()
            ->where('line_id', $this->line->id,)
            ->whereNotIn('product_id', $this->inputs)
            ->delete();

        foreach ($this->outputs as $output) {

            LineOutputs::query()->updateOrCreate([

                'line_id' => $this->line->id,
                'product_id' => $output,
            ]);
        }

        LineOutputs::query()
            ->where('line_id', $this->line->id,)
            ->whereNotIn('product_id', $this->outputs)
            ->delete();

        $this->redirectRoute('panel.lines');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-line', [

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
