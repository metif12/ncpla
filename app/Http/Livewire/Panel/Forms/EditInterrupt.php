<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Interrupt;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditInterrupt extends Component
{
    public string $name = '';
    public string $code = '';

    public Interrupt $interrupt;

    public function mount(Interrupt $interrupt)
    {
        $this->interrupt = $interrupt;

        $this->name = $interrupt->name;
        $this->code = $interrupt->code;
    }

    protected function getRules()
    {
        return [
            'name' => ['required','string', Rule::unique('interrupts','name')->ignore($this->interrupt ? $this->interrupt->id : 0)],
            'code' => ['required','string', Rule::unique('interrupts','code')->ignore($this->interrupt ? $this->interrupt->id : 0)],
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();

        $this->interrupt->update([

            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->redirectRoute('panel.interrupts');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-interrupt')
            ->layout('panel.layout');

    }
}
