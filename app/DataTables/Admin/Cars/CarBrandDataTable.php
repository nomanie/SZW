<?php

namespace App\DataTables\Admin\Cars;

use App\DataTables\DataTableExpander;
use App\Models\System\Cars\CarBrand;
use App\Traits\JsonResponseTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CarBrandDataTable extends DataTable
{
    use DataTableExpander, JsonResponseTrait;

    protected string $printPreview = 'vendor.datatables.print';
    protected string $model = CarBrand::class;
    protected $allowCSVExport = true;
    protected $allowPDFExport = true;
    protected array $actions = ['print', 'csv', 'excel', 'pdf', 'deleteSelectedRows'];
    protected array $dropdownActions = ['edit', 'show', 'delete'];
    protected string $route = 'admin.cars.brand';
    protected string $id = 'carbrand-table';

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
            ->addColumn('action', function($row){
                return '<div class="w-100 cursor-pointer dropdown-action">
                                    <div class="w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li data-href="'.route($this->route.'.show' , $row->id).'" class="dt-ajax" data-type="show">
                                        <i class="fa fa-circle-info"></i>
                                            Szczegóły
                                        </li>
                                        <li data-href="'.route($this->route.'.edit' , $row->id).'" class="dt-ajax" data-type="edit">
                                            <i class="fa fa-pencil"></i>
                                            Edytuj
                                        </li>
                                        <li data-href="'.route($this->route.'.destroy' , $row->id).'" class="dt-ajax" data-type="delete">
                                            <i class="fa fa-trash"></i>
                                            Usuń
                                        </li>
                                    </ul>
                                </div>';
            })
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
            ->setTableId($this->id)
            ->autoWidth(true)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->lengthMenu([[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "Wszystkie"]])
            ->pageLength(10)
            ->pagingType('simple_numbers')
            ->dom("<'mt-2'B><'dt-toolbar d-flex justify-content-between mt-3'lf>r<'table--scrollable't><'d-flex justify-content-between mt-3'ip>")
            ->orderBy(1)
            ->language($this->getLanguageByName('pl'))
            ->selectStyleMultiShift()
            ->selectSelector('td:not(.no-select)')
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
                            'extend' => 'pdf',
                            'text' => '<i class="fa-solid fa-file-pdf"></i> PDF',
                            'orientation' => 'landscape',
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
                            ],
                            'selected' => true
                        ],
                        [
                            'extend' => 'csv',
                            'text' => '<i class="fa-solid fa-table-cells-large"></i> CSV',
                            'exportOptions' => [
                                'columns' => ':visible :not(.not-exportable)',
                            ],
                            'selected' => true
                        ],
                        [
                            'extend' => 'pdf',
                            'text' => '<i class="fa-solid fa-file-pdf"></i> PDF',
                            'orientation' => 'landscape',
                            'exportOptions' => [
                                'columns' => ':visible :not(.not-exportable)',
                            ],
                            'selected' => true
                        ],
                        [
                            'extend' => 'print',
                            'text' => '<i class="fa-solid fa-print"></i> Drukuj',
                            'exportOptions' => [
                                'columns' => ':visible :not(.not-exportable)',
                            ],
                            'selected' => true
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
                    'extend' => 'deleteSelectedRows',
                    'delete_route' =>'admin.cars.brand.destroy',
                    'selected' => true
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
                ]
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
                ->addClass('text-center no-select'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return $this->filename . date('YmdHis');
    }

    public function pdf()
    {
        $snappy = app('snappy.pdf.wrapper');

        $data = $this->getSelectedRows() ?? null;
        if ($data) {
            $view = view($this->printPreview, compact('data'));
            return $snappy->loadHTML()->download($this->getFilename() . '.pdf');
        }
        return $snappy->loadHTML($this->printPreview())->download($this->getFilename() . '.pdf');
    }

    /** Ustawia nazwę generowanego pliku
     * @param string $filename
     * @return static
     */
    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Eksport danych do CSV, obsługuje eksport tylko wybranych wierszy
     *
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     *
     * @throws \Exception
     */
    public function csv()
    {
        set_time_limit(3600);

        $path = $this->getFilename() . '.' . strtolower($this->csvWriter);

        $excelFile = $this->buildExcelFile();

        // @phpstan-ignore-next-line
        return $this->buildExcelFile()->download($path, $this->csvWriter);
    }

    /**
     * Budowa pliku CSV i przygotowanie do eksportu.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    protected function buildExcelFile()
    {
        $collection = $this->getSelectedRows() ?? $this->getDataForExport();

        return new $this->exportClass($this->convertToLazyCollection($collection));
    }

    /**
     * Pobranie zaznaczonych wierszy
     *
     * @return collection|null
     *
     */
    protected function getSelectedRows(): collection|null
    {
        if (isset($this->request()->all()['data'])) {
            $ids = $this->request()->all()['data'];
            $cols = [];
            foreach ($this->getExportColumnsFromBuilder() as $col) {
                if ($col['exportable'] === true) {
                    $cols[] = $col['name'];
                }
            }
            $collection = collect((new $this->model)->whereIn('id', $ids)->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")->get($cols)->toArray());
        }
        return $collection ?? null;
    }

    /**
     * Display printable view of datatables.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function printPreview(): Renderable
    {
        $data = $this->getSelectedRows() ?? $this->getDataForPrint();

        return view($this->printPreview, compact('data'));
    }
}
