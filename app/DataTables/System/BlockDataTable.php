<?php

namespace App\DataTables\System;

use App\Models\block;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BlockDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() // اضافه کردن ستون #
            ->addColumn('ناحیه', fn($row) => $row->guzars->district->district_Name ?? 'ناموجود')
            ->addColumn('گذر', fn($row) => $row->guzars->guzer_Number ?? 'ناموجود')
            ->addColumn('بلاک', fn($row) => $row->block_Number ?? 'ناموجود')
            ->addColumn('عمل', function ($row) {


                $deleteBtn = '';
                if (auth()->user()->can('delete_block')) {
                    $deleteBtn = '
                        <form action="' . route('block.delete', [$row->id]) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" class="delete btn btn-danger sharp" data-id="' . $row->id . '" style="margin-right:10px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>';
                }

                return   $deleteBtn;
            })
            ->rawColumns(['عمل']); // لازم برای HTML خروجی
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(block $model): QueryBuilder
    {
        $query = $model->with(['guzars.district'])->orderByDesc('id');

        if (Auth::check() && Auth::user()->district_id) {
            $query->whereHas('guzars', function ($q) {
                $q->where('district_id', Auth::user()->district_id);
            });
        }

        if (request()->filled('district')) {
            $query->whereHas('guzars', function ($q) {
                $q->where('district_id', request('district'));
            });
        }

        // if (request()->filled('district')) {
        //     $query->where('district_id', request('district'));
        // }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('guzar-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => '<"top d-flex justify-content-between"lB>rt<"bottom d-flex justify-content-between"ip>',
                'order' => [[0, 'desc']],
            ])
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->addClass('text-center'),
            Column::make('ناحیه')->addClass('text-center'),
            Column::make('گذر')->addClass('text-center'),
            Column::make('بلاک')->addClass('text-center'),
            Column::computed('عمل')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center no-search')
                ->title('عملیه'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Guzar_' . now()->format('Ymd_His');
    }
}
