<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\Packages;
use Yajra\DataTables\Html\Column;

class StatusDataTable extends dataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function($model){
               $action = '<div class="d-flex gap-2"><a href="'.route('admin.status.edit',["$model->id"]).'" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
        
                return $action;
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(Packages $model)
    {
        $model = $model::with(['status']);        
        $Query =  $model->newQuery();
        return $Query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $params = $this->getBuilderParameters();
        $params['buttons'] = [['customCreate']];
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction()
            ->parameters($params);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('id')
                ->title('ID')
                ->orderable(true)
                ->searchable(true)
                ->width('10%'),
            Column::computed('name')
                ->title('Name')
                ->orderable(true)
                ->searchable(true)
                 ->width('30%'),
            Column::computed('description')
                ->title('Description')
                ->orderable(true)
                ->searchable(true),
                 Column::computed('plan_type')
                ->title('Type')
                ->orderable(true)
                ->searchable(true),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Status_' . date('YmdHis');
    }
}
