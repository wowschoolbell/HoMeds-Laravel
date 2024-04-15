<?php

namespace Modules\Superadmin\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\User;

class UserDataTable extends dataTable
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
            ->addColumn('role', function ($model) {
                $badge = '';
                foreach($model->allRoles() as $role){
                    $badge .= "<span class='badge badge-primary'>".$role."</span><br>";
                }
                return $badge;
            })
            ->addColumn('action', function($model){
                $action = '<a href="javascript:void(0)" data-user_id="'.$model->id.'" data-url="'.route('sa.backend_users.edit',["$model->id"]).'" data-toggle="modal" data-target="#usermodel" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
                // $action .= '<button class="btn btn-sm btn-danger btn-delete" type="button" data-delete-route="'.route('sa.backend_users.destroy', $model->id).'" data-redirect="'.route('sa.backend_users.index').'" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>';

                return $action;
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(User $model)
    {
        return $model->query();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $params = $this->getBuilderParameters();
        // $params['order'] = [[7, 'desc']];
        // $params['drawCallback'] = 'function() {
        //     $("img.lazy").lazyload();
        // }';
        $params['buttons'] = ['csv']; 
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
            'name',
            'email',
            'role'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
