<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\items;
use Yajra\DataTables\Html\Column;

class ItemDataTable extends dataTable
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
               $action = '<div class="d-flex gap-2"><a href="'.route('admin.items.edit',["$model->id"]).'" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
        
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

    public function query(items $model)
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
                ->title('S.NO')
                ->orderable(true)
                ->searchable(true)
                ->width('20%'),
            Column::computed('item_code')
                ->title('Item Code')
                ->orderable(true)
                ->searchable(true)
                 ->width('20%'),
            Column::computed('store_item_code')
                ->title('Store Item Code')
                ->orderable(true)
                ->searchable(true),
            Column::computed('category')
                ->title('Item Category')
                ->orderable(true)
                ->searchable(true),
            Column::computed('name')
                ->title('Item Name')
                ->orderable(true)
                ->searchable(true),
             Column::computed('cure_disease')
                ->title('Disease')
                ->orderable(true)
                ->searchable(true),
              Column::computed('status', function($data){ $formatedDate = "Active";  return $formatedDate; })
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
        return 'Items_' . date('YmdHis');
    }
}
