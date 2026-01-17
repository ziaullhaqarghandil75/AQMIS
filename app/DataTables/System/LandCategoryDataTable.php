<?php

namespace App\DataTables\System;

use App\Models\landCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LandCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('district_name', fn($row) => $row->zone->district->district_Name ?? 'ناموجود')
            ->addColumn('zone_name', fn($row) => $row->zone->zone_Name ?? 'ناموجود')
            ->addColumn('land_Category_Name', fn($row) => $row->land_Category_Name ?? 'ناموجود')
            ->addColumn('land_category_location', fn($row) => $row->land_category_location ?? 'ناموجود')
            ->addColumn('land_category_unit_Price', fn($row) => $row->land_category_unit_Price ?? 'ناموجود')
            ->addColumn('عمل', function ($row) {


                $deleteBtn = '';
                if (auth()->user()->can('delete_land_category')) {
                    $deleteBtn = '
                        <form action="' . route('land_category.delete', [$row->id]) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" class="delete btn btn-danger sharp" data-id="' . $row->id . '" style="margin-right:10px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>';
                }
                $editBtn = '';
                if (auth()->user()->can('edit_land_category')) {
                    $editBtn = '
                                  <button
                                    class="btn btn-success sharp edit-land-category"
                                    data-id="' . $row->id . '"
                                    data-district="' . $row->zone->district_id . '"
                                    data-zone="' . $row->zone_id . '"
                                    data-name="' . $row->land_Category_Name . '"
                                    data-price="' . $row->land_category_unit_Price . '"
                                    data-location="' . $row->land_category_location . '">
                                    <i class="fas fa-edit"></i>
                                </button>
                            ';
                }

                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['عمل']); // لازم برای HTML خروجی
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(landCategory $model): QueryBuilder
    {
        $query = $model->with(['zone.district'])->orderByDesc('id');

        if (Auth::check() && Auth::user()->district_id) {
            $query->whereHas('zone', function ($q) {
                $q->where('district_id', Auth::user()->district_id);
            });
        }

        if (request()->filled('district')) {
            $query->whereHas('zone', function ($q) {
                $q->where('district_id', request('district'));
            });
        }
        // Log::info('LandCategory Query: ' . $query->toSql());
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('zone-table')
            ->columns($this->getColumns())
            ->ajax([
                'url'  => route('land_category.index'),
                'type' => 'POST',
                'data' => 'function(d) {
                d._token   = "' . csrf_token() . '";
                d.district = $("#district_id").val();
            }',
            ])
            ->parameters([
                'processing' => true,
                'serverSide' => true,
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
            Column::computed('DT_RowIndex')->title('#')->addClass('text-center'),
            Column::make('district_name')->title('ناحیه')->addClass('text-center'),
            Column::make('zone_name')->title('زون')->addClass('text-center'),
            Column::make('land_Category_Name')->title('کتگوری')->addClass('text-center'),
            Column::make('land_category_location')->title('موقعیت ساحه')->addClass('text-center'),
            Column::make('land_category_unit_Price')->title('قیمت')->addClass('text-center'),
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
