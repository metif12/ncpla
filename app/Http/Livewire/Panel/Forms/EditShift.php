<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Shift;
use Illuminate\Support\Carbon;
use Livewire\Component;

class EditShift extends Component
{
    public Shift $shift;

    public string $start = '';
    public string $end = '';

    public function mount(Shift $shift)
    {
        $this->shift = $shift;

        $this->start = Carbon::parse($shift->start)->format('H:i');
        $this->end = Carbon::parse($shift->end)->format('H:i');
    }

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

        $this->shift->update([

            'start' => $this->start,
            'end' => $this->end,
        ]);

        $this->redirectRoute('panel.shifts');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-shift')
            ->layout('panel.layout');

    }
}
