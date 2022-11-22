<?php

namespace App\DataTables\Admin\Cars;

use App\Models\System\Cars\CarBrand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CarBrandDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'path.to.action.view')
            ->addColumn('action', 'carbrand.action')
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\System\Cars $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CarBrand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('carbrand-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->lengthMenu([ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "Wszystkie"] ])
                    ->pageLength(10)
                    ->pagingType('simple_numbers')
                    ->dom("<'mt-2'B><'dt-toolbar d-flex justify-content-between mt-3'lf>r<t><'d-flex justify-content-between mt-3'ip>")
                    ->orderBy(1)
                    ->selectStyleMultiShift()
                    ->buttons([
                        ['extend' =>'copy', 'text' => '<i class="fa-regular fa-copy"></i> Skopiuj', 'className' => 'btn-primary'],
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CarBrand_' . date('YmdHis');
    }
}
