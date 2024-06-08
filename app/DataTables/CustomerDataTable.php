<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\customers;
use Yajra\DataTables\Html\Column;

class CustomerDataTable extends dataTable
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
               $action = '<div class="d-flex gap-2"><a href="'.route('admin.customers.edit',["$model->id"]).'" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
        
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

    public function query(customers $model)
    {
        $model = $model::with(['user']);        
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
                ->title('Customer ID')
                ->orderable(true)
                ->searchable(true)
                ->width('20%'),
            Column::computed('name')
                ->title('Customer Name')
                ->orderable(true)
                ->searchable(true)
                 ->width('20%'),
            Column::computed('mobile_number')
                ->title('Mobile Number')
                ->orderable(true)
                ->searchable(true),
            Column::computed('address')
                ->title('Address')
                ->orderable(true)
                ->searchable(true),
            Column::computed('status', function($data){  return $data=="1"?"Active":"In-active" ; })
                ->title('Status')
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
        return 'Customer_' . date('YmdHis');
    }
}
