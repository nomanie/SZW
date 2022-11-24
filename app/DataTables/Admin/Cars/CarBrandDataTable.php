<?php

namespace App\DataTables\Admin\Cars;

use App\DataTables\DataTableExpander;
use App\Models\System\Cars\CarBrand;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CarBrandDataTable extends DataTable
{
    use DataTableExpander;
    protected string $printPreview = 'vendor.datatables.print';
    protected string $model = CarBrand::class;
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
            ->autoWidth(true)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->lengthMenu([[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "Wszystkie"]])
            ->pageLength(10)
            ->pagingType('simple_numbers')
            ->dom("<'mt-2'B><'dt-toolbar d-flex justify-content-between mt-3'lf>r<t><'d-flex justify-content-between mt-3'ip>")
            ->orderBy(1)
            ->language($this->getLanguageByName('pl'))
            ->selectStyleMultiShift()
            ->stateSave(true)
            ->buttons([
                ['extend' => 'collection',
                    'text' => 'Export',
                    'className' => 'action-buttons mb-2 fs-10',
                    'buttons' => [
                        [
                            'extend' => 'copy',
                            'text' => '<i class="fa-regular fa-copy"></i> Skopiuj',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)'
                            ],
                        ],
                        [
                            'extend' => 'csv',
                            'text' => '<i class="fa-solid fa-table-cells-large"></i> CSV',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)'
                            ],
                        ],
                        [
                            'extend' =>'pdf',
                            'text' =>'<i class="fa-solid fa-file-pdf"></i> PDF',
                            'orientation' =>'landscape',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)'
                            ],
                        ],
                        [
                            'extend' => 'print',
                            'text' => '<i class="fa-solid fa-print"></i> Drukuj',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)'
                            ],
                        ],
                    ]
                ],
                [
                    'extend' => 'collection',
                    'text' => 'Zaznaczone',
                    'className' => 'action-buttons mb-2 fs-10',
                    'buttons' => [
                        [
                            'extend' => 'copy',
                            'text' => '<i class="fa-regular fa-copy"></i> Skopiuj',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)',
                                'modifier' => [
                                'selected' => true
                                ]
                            ],
                        ],
                        [
                            'extend' => 'csvHtml5',
                            'text' => '<i class="fa-solid fa-table-cells-large"></i> CSV',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)',
                                'modifier' => [
                                'selected' => true
                                ]
                            ],
                        ],
                        [
                            'extend' => 'pdf',
                            'text' => '<i class="fa-solid fa-file-pdf"></i> PDF',
                            'orientation' => 'landscape',
                            'exportOptions' =>  [
                            'columns' =>  ':visible :not(.not-exportable)',
                                'modifier' =>  [
                                'selected' =>  true
                                ]
                            ],
                        ],
                        [
                            'extend' => 'print',
                            'text' => '<i class="fa-solid fa-print"></i> Drukuj',
                            'exportOptions' => [
                            'columns' => ':visible :not(.not-exportable)',
                                'modifier' => [
                                'selected' => true
                                ]
                            ],
                        ],
                    ]
                ],
                [
                    'extend' => 'colvis',
                    'text' => 'Kolumny',
                    'className' => 'btn fs-10 ms-1 mb-2',
                ],
                [
                    'text' => 'Usuń zaznaczone',
                    'className' => 'btn btn-danger fs-10 mb-2',
                ],
                [
                    'text' => 'Zaznacz wszystko',
                    'className' => 'btn btn-success fs-10 mb-2',
                    'extend' => 'selectAll'
                ],
                [
                    'text' => 'Odznacz wszystko',
                    'className' => 'btn btn-success fs-10 mb-2',
                    'extend' => 'selectNone'
                ],
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
            Column::make('id'),
            Column::make('name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Marki_samochodów' . date('YmdHis');
    }

    public function pdf()
    {
        $snappy = app('snappy.pdf.wrapper');
        if (isset($this->request()->all()['data'])) {
            $ids = $this->request()->all()['data'];
            $cols = [];
            foreach ($this->getExportColumnsFromBuilder() as $col) {
                if ($col['exportable'] === true) {
                    $cols[] = $col['name'];
                }
            }

            $data = (new $this->model)->whereIn('id', $ids)->get($cols)->toArray();
            $view =  view($this->printPreview, compact('data'));
            return $snappy->loadHTML($view)->download($this->getFilename().'.pdf');
        }

        return $snappy->loadHTML($this->printPreview())->download($this->getFilename().'.pdf');
    }
}
