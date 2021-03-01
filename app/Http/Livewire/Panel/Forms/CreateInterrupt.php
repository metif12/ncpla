<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Interrupt;
use Livewire\Component;

class CreateInterrupt extends Component
{
    public string $name = '';
    public string $code = '';

    public function mount()
    {
        $this->code = generateCode();
    }

    protected function getRules()
    {
        return [
            'name' => 'required|string|unique:interrupts,name',
            'code' => 'required|string|unique:interrupts,code',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();

        Interrupt::query()->create([

            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->redirectRoute('panel.interrupts');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-interrupt')
            ->layout('panel.layout');

    }
}
