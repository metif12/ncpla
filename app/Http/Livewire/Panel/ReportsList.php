<?php

namespace App\Http\Livewire\Panel;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.reports-list', [

            'reports' => $this->getReportQuery()->paginate(15),
        ])
        ->layout('panel.layout');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getReportQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Report::query()
            ->whereIn('line_id', auth()->user()->lines()->pluck('lines.id'))
            ->with(['line','user','shift'])
            ->Where('code', 'like', "%{$this->search}%");
    }
}
