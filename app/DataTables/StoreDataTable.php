<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\store;

class StoreDataTable extends dataTable
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
               $action = '<div class="d-flex gap-2"><a href="'.route('admin.store.edit',["$model->id"]).'" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
               
                $action .= '<a href="'.route('admin.store.edit',["$model->id"]).'?view=true" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i  class="mdi mdi-eye-outline"></i></a>&nbsp; </div>';
               

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

    public function query(store $model)
    {
        $model = $model::with(['user']);
        
        if ($status = @request()->status) {
            if ($status != "all") {
                $model->where('status', $status);
            }
        }
 


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
            "id",
            'name',
            'contact_person_name', 'phone', 'mobile_number', 'email',"app_status","status"
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Store_' . date('YmdHis');
    }
}
