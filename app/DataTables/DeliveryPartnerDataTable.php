<?php

namespace App\DataTables;

use App\Models\DeliveryPartner;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class DeliveryPartnerDataTable extends dataTable
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
            ->addColumn('first_name', function ($model) {
                $name = $model->first_name;

                if ($model->middle_name) {
                    $name .= ' '.$model->middle_name;
                }
                if ($model->last_name) {
                    $name .= ' '.$model->last_name;
                }

                return $name;
            })
            ->addColumn('action', function($model){
                $action = '<a href="' . route('admin.delivery_partner.edit', $model->user->delivery_partner->id) . '" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>';

                return $action;
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DeliveryPartner $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(DeliveryPartner $model)
    {
        $model = $model::with(['user']);

        if ($status = @request()->status) {
            if ($status != 0) {
                $model->where('app_statuses_id', $status);
            }
        }


        return $model->newQuery();
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
            Column::computed('user.username')
                ->title('Partner ID')
                ->orderable(true)
                ->searchable(true),
            Column::computed('first_name')
                ->title('Name')
                ->orderable(true)
                ->searchable(true),
            Column::computed('user.email')
                ->title('Email')
                ->orderable(true)
                ->searchable(true),
            Column::computed('phone')
                ->orderable(true)
                ->searchable(true),
            Column::computed('aadhar')
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
        return 'DeliveryPartners_' . date('YmdHis');
    }
}
