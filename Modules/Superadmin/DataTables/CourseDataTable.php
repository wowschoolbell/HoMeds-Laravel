<?php

namespace Modules\Superadmin\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Helpers\AppHelper;
use App\Models\Course;
use Carbon\Carbon;

class CourseDataTable extends dataTable
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
            ->addColumn('category', function ($model) {
                return @$model->category->name;
            })
            ->addColumn('user', function ($model) {
                return @$model->user->name;
            })
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->format('d-m-Y');
            })
            ->addColumn('status', function ($model) {
                $btn_class = ($model->status == Course::APPROVED) ? "btn-success": "btn-danger";

                $route = route('sa.courses.change_status');
                $status = Course::$status;
                $li='';
                
                foreach($status as $key => $value){
                $li.="<li><a href='#' route='$route' data-id='$model->id' data-active=$key class='dropdown-item btn-active'>$value</a></li>";
                }
                return "<div class='btn-group'>
                            <button type='button' class='btn $btn_class btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".Course::$status[$model->status]."</button>
                            <div class='dropdown-menu animated lightSpeedIn'>
                                $li
                            </div>
                        </div>";
            })
            ->addColumn('action', function ($model) {
                $action = '<a href="'.route('sa.courses.edit', $model->id).'" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;&nbsp;';
                $action .= '<button class="btn btn-sm btn-danger btn-delete" type="button" data-delete-route="'.route('sa.courses.destroy', $model->id).'" data-redirect="'.route('sa.courses.index').'" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>';

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

    public function query(Course $model)
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
            'title',
            'user',
            'category',
            'created_at',
            'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Course_' . date('YmdHis');
    }
}
