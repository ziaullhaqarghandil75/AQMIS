<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('fullName', function ($user) {
                return $user->name . ' ' . $user->last_name;
            })
            ->filterColumn('fullName', function ($query, $keyword) {
                $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$keyword}%"]);
            })
            ->addColumn('image', function ($user) {
                $url = $user->img ? asset($user->img) : asset('images/user.png');
                return '
                    <div style="position: relative; display: inline-block;">
                        <img src="' . $url . '" width="35" height="35" class="rounded-circle">
                        <span style="
                            position: absolute;
                            bottom: 0;
                            right: 0;
                            width: 15px;
                            height: 15px;
                            border-radius: 50%;
                            border: 2px solid white;
                            background-color: ' . ($user->isOnline() ? 'green' : 'red') . ';
                        "></span>
                    </div>';
            })
            ->addColumn('role_user', function ($user) {
                return $user->roles->first()?->description ?? '';
            })
            ->filterColumn('role_user', function ($query, $keyword) {
                $query->whereHas('roles', function ($q) use ($keyword) {
                    $q->where('description', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('status', function ($user) {
                if (Auth::user()->can('active_inactive')) {
                    return $user->status == 1
                        ? '<a href="' . route('user.status', $user->id) . '">
                    <span class="badge light badge-success badge-pill">
                        <i class="icon-user-check"></i> فعال
                    </span>
               </a>'
                        : '<a href="' . route('user.status', $user->id) . '">
                    <span class="badge light badge-danger badge-pill">
                        <i class="icon-user-cancel"></i> غیر فعال
                    </span>
               </a>';
                } else {
                    return $user->status == 1
                        ? '<span class="badge badge-success">
                    <i class="icon-user-check"></i> فعال
               </span>'
                        : '<span class="badge badge-danger">
                    <i class="icon-user-cancel"></i> غیر فعال
               </span>';
                }
            })
            ->addColumn('action', function ($user) {
                $buttons = '<div class="dropdown">
				<a href="#" class="badge bg-info-400 badge-pill dropdown-toggle"
						data-toggle="dropdown"><i class="icon-gear mr-1"></i></a>
				<div class="dropdown-menu">';
                if (Auth::user()->can('user_profile')) {
                    $buttons .= '<a class="dropdown-item" href="' . route('user.profile', $user->id) . '">
                                    <i class="fas fa-users-cog"></i> پروفایل
                                </a>';
                }
                if (Auth::user()->can('edit_user')) {
                    $buttons .= '<a class="dropdown-item editUserBtn text-success" href="javascript:void(0);"
                                data-toggle="modal"
                                data-target="#edit_user_modal"
                                data-id="' . $user->id . '">
                                <i class="fa fa-edit"></i> تصحیح
                            </a>';
                }
                if (Auth::user()->can('delete_user')) {
                    $buttons .= '<form action="' . route('users.destroy', $user->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="delete dropdown-item text-danger">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </form>';
                }
                if (Auth::user()->can('delete_user')) {
                    $buttons .= '<a class="dropdown-item text-warning" href="' . route('logout_specific_user', $user->id) . '">
                                    <i class="fas fa-sign-out-alt"></i> خروج از سیستم
                                </a>';
                }
                $buttons .= '</div></div>';
                return $buttons;
            })
            ->rawColumns(['image', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('roles');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->parameters([
                'dom' => '<"top d-flex align-items-center justify-content-between mb-2"l>rt<"bottom d-flex align-items-center justify-content-between mt-2"ip>',
                'initComplete' => 'function(){
                    const table = this.api();
                    const $thead = $(table.table().header());

                    if ($thead.find("tr.filter").length === 0) {
                        const $filterRow = $thead.find("tr").clone().addClass("filter");

                        $filterRow.find("th").each(function(){
                            const $currentTh = $(this);

                            if(!$currentTh.hasClass("no-search")){
                                const input = $(\'<input type="text" class="form-control form-control-sm text-center" placeholder="جستجو..."/>\');
                                $currentTh.html(input);

                                $(input).on("click", function(event){
                                    event.stopPropagation();
                                });

                                $(input).on("keyup change clear", function(){
                                    if (table.column($currentTh[0].cellIndex).search() !== this.value) {
                                        table.column($currentTh[0].cellIndex).search(this.value).draw();
                                    }
                                });

                            } else {
                                $currentTh.empty();
                            }
                        });
                        $thead.append($filterRow);
                    }
                }'
            ])
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }


    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('#')
                ->addClass('text-center no-search')
                ->orderable(false)
                ->searchable(false),
            Column::make('image')->addClass('text-center  no-search')->title('تصویر'),
            Column::make('fullName')->addClass('text-center')->title('اسم مکمل'),
            Column::make('email')->addClass('text-center')->title('ایمیل'),
            Column::make('phone')->addClass('text-center')->title('شماره تماس'),
            Column::make('role_user')->addClass('text-center')->title('سطح دستریسی'),
            Column::make('status')->addClass('text-center no-search')->title('حالت'),
            Column::computed('action')
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
        return 'User_' . date('YmdHis');
    }
}
