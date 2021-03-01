<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Material;
use App\Models\MaterialAttribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use Livewire\Component;

class EditMaterial extends Component
{
    public string $name = '';
    public string $unit = '';

    public array $attrs = [];

    public Material $material;

    public function mount(Material $material)
    {
        $this->material = $material;

        $this->name = $material->name;
        $this->unit = $material->unit;

        $this->attrs = $material->material_attributes->toArray() ?? [];
    }

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

    public function updated()
    {
        $this->validate();
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

    public function storeMaterial()
    {
        $this->validate();

        $this->material->update([

            'name' => $this->name,
            'unit' => $this->unit,
        ]);

        $names = [];

        foreach ($this->attrs as $attr){

            MaterialAttribute::query()->updateOrCreate(
                [
                    'material_id' => $this->material->id,
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

        MaterialAttribute::query()
            ->where('material_id' , $this->material->id)
            ->whereNotIn('name' , $names)
            ->delete();

        $this->redirectRoute('panel.materials');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-material')
            ->layout('panel.layout');

    }
}
