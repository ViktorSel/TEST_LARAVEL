<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DataTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Url')
                ->sortable()
                ->searchable(),
            Column::make('Count', 'count')
                ->sortable()
                ->searchable(),
            Column::make('Last visit', 'visited_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query()
    {
        return [];
    }
}
