<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Shift;
use Livewire\Component;

class CreateShift extends Component
{
    public string $start = '';
    public string $end = '';

    protected function getRules()
    {
        return [
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeShift()
    {
        $this->validate();

        Shift::query()->create([

            'start' => $this->start,
            'end' => $this->end,
            'code' => generateCode(),
        ]);

        $this->redirectRoute('panel.shifts');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-shift')
            ->layout('panel.layout');

    }
}
