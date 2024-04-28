<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\City;
use Yajra\DataTables\Html\Column;

class CityDataTable extends dataTable
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
                return '<a href="javascript:void(0)" data-category_id="'.$model->id.'" data-url="'.route('admin.cities.edit',["$model->id"]).'" data-toggle="modal" data-target="#citymodel" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(City $model)
    {
        return $model::with(['state'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $params = $this->getBuilderParameters();
        $params['buttons'] = [[
            'text' => '<i class="mdi mdi-plus"></i> create',
            'className' => 'citymodel',
            'action' => 'function(e, dt, node, config) {
                  $(".citymodel").modal("show");
             }']];
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
            Column::computed('state.name')
                ->title('State')
                ->orderable(true)
                ->searchable(true),
            Column::computed('area')
                ->orderable(true)
                ->searchable(true),
            Column::computed('city')
                ->orderable(true)
                ->searchable(true),
            Column::computed('pincode')
                ->orderable(true)
                ->searchable(true)];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'City_' . date('YmdHis');
    }
}
