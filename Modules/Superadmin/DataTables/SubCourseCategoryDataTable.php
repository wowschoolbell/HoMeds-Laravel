<?php

namespace Modules\Superadmin\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\CourseCategory;
use App\Models\SubCourseCategory;

class SubCourseCategoryDataTable extends dataTable
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
        ->editColumn('category', function($model) {
            return $model->category->name;
        })
            ->addColumn('action', function($model){
                $action = '<a href="javascript:void(0)" data-category_id="'.$model->id.'" data-url="'.route('sa.sub_course_categories.edit',["$model->id"]).'" data-toggle="modal" data-target="#subcoursecategorymodal" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
                // $action .= '<button class="btn btn-sm btn-danger btn-delete" type="button" data-delete-route="'.route('course_categories.destroy', $model->id).'" data-redirect="'.route('course_categories.index').'" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>';

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

    public function query(SubCourseCategory $model)
    {
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
        $params['buttons'] = [];
        $params['buttons'] = [[
            'text' => '<i class="mdi mdi-plus"></i> create',
            'className' => 'subcoursecategorymodal',
            'action' => 'function(e, dt, node, config) {
                  $("#subcoursecategorymodal").modal("show");
             }'], 'csv'];
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
            'category'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CourseCategory_' . date('YmdHis');
    }
}
