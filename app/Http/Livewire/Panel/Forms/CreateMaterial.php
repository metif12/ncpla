<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Material;
use Livewire\Component;

class CreateMaterial extends Component
{
    public string $name = '';
    public string $unit = '';

    protected function getRules()
    {
        return [
            'name' => 'required|string|unique:materials,name',
            'unit' => 'required|string',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeMaterial()
    {
        $this->validate();

        Material::query()->create([

            'name' => $this->name,
            'unit' => $this->unit,
            'code' => generateCode(),
        ]);

        $this->redirectRoute('panel.materials');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-material')
            ->layout('panel.layout');

    }
}
