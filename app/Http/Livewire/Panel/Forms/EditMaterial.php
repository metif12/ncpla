<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Material;
use Livewire\Component;

class EditMaterial extends Component
{
    public string $name = '';
    public string $unit = '';

    public Material $material;

    public function mount(Material $material)
    {
        $this->material = $material;

        $this->name = $material->name;
        $this->unit = $material->unit;
    }

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

        $this->material->update([

            'name' => $this->name,
            'unit' => $this->unit,
        ]);

        $this->redirectRoute('panel.materials');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-material')
            ->layout('panel.layout');

    }
}
