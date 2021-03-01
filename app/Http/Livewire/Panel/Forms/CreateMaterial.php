<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Material;
use App\Models\MaterialAttribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use Livewire\Component;

class CreateMaterial extends Component
{
    public string $name = '';
    public string $unit = '';

    public array $attrs = [];

    protected function getRules()
    {
        $rules = [
            'name' => 'required|string|unique:materials,name',
            'unit' => 'required|string',
        ];

        foreach ($this->attrs ?? [] as $i => $attr) {

            $rules["attrs.$i.name"] = "required|string";
            $rules["attrs.$i.unit"] = "nullable|string";
            $rules["attrs.$i.merge_type"] = "required|string";

            switch ($attr['type']){

                case 'text' :
                    $rules["attrs.$i.default"] = "nullable|string";
                    break;

                case 'number' :
                    $rules["attrs.$i.default"] = "nullable|regex:/^\d+(\.\d+)?$/";
                    break;

            }

        }

        return $rules;
    }

    public function addAttr()
    {
        $this->attrs [] = [

            'name' => '',
            'type' => Material::$types[0]['value'],
            'unit' => '',
            'default' => '',
            'merge_type' => Material::$merge_types[0]['value'],
        ];
    }

    public function remAttr($i)
    {
        array_splice($this->attrs, $i,1);
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeMaterial()
    {
        $this->validate();

        $material = Material::query()->create([

            'name' => $this->name,
            'unit' => $this->unit,
            'code' => generateCode(),
        ]);

        foreach ($this->attrs as $attr){

            $attr['material_id'] = $material->id;
            MaterialAttribute::query()->create($attr);
        }

        $this->redirectRoute('panel.materials');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-material')
            ->layout('panel.layout');

    }
}
