<?php

namespace App\DataTables;

use App\Models\Language;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LanguageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return datatables($query)
            ->addIndexColumn()

            ->addColumn('status', function ($row) {
                return view('languages.datatables_status', ['id' => $row->id, 'status' => $row->status])->render();
            })
            ->addColumn('action', 'languages.datatables_actions')->rawColumns(['status', 'action']);

        //return $dataTable->addColumn('action', 'languages.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Language $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Language $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'         => [[0, 'desc']],
                'lengthMenu' => [
                    [ 10, 25, 50,100, -1 ],
                    [ '10', '25', '50','100', 'All' ]
                ],
                'buttons'   => [
                    ['extend' => 'pageLength', 'className' => 'button-margin btn btn-default btn-sm no-corner',],
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'language_name',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'languages_datatable_' . time();
    }
}
