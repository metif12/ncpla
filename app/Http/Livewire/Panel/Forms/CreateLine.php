<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Line;
use Livewire\Component;

class CreateLine extends Component
{
    public string $name = '';

    public array $attrs = [];

    public array $parent_lines = [];
    public array $materials = [];
    public array $inputs = [];
    public array $outputs = [];

    public array  $types = [

        [
            'name' => 'متنی',
            'value' => 'text',
        ],
        [
            'name' => 'عددی',
            'value' => 'number',
        ],
    ];

    protected function getRules()
    {
        return [
            'name' => 'required|string|unique:lines,name',

            'parent_lines.*' => 'required|integer',
            'materials.*' => 'required|integer',
            'inputs.*' => 'required|integer',
            'outputs.*' => 'required|integer',

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
            'type' => 'text',
            'unit' => '',
            'default' => '',

        ];
    }

    public function remAttr($i)
    {
        array_splice($this->attrs, $i,1);
    }

    public function storeProduct()
    {
        $this->validate();

        Line::query()->create([

            'name' => $this->name,
            'code' => strtoupper(dechex(time())),
            'parent_lines' => $this->attrs,
            'materials' => $this->attrs,
            'inputs' => $this->attrs,
            'outputs' => $this->attrs,
        ]);

        $this->redirectRoute('panel.lines');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-line')
            ->layout('panel.layout');

    }
}
