<?php

namespace App\Http\Livewire\Panel\Forms;

use Illuminate\Support\Str;
use Junges\ACL\Http\Models\Group;
use Livewire\Component;

class CreateGroup extends Component
{
    public string $name = '';

    protected function getRules(): array
    {
        return [
            'name' => 'required|string|unique:groups,name'
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeGroup()
    {
        $this->validate();

        $group = Group::query()->create([
            'name' => $this->name,
            'slug' => Str::slug($this->name,'-','fa'),
        ]);

        $this->redirectRoute('panel.group-edit', $group);
    }

    public function render()
    {
        return view('livewire.panel.forms.create-group')
            ->layout('panel.layout');
    }
}
