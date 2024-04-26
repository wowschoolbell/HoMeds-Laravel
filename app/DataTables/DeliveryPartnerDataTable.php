<?php

namespace App\DataTables;

use App\Models\DeliveryPartner;
use Yajra\DataTables\Services\DataTable;
use App\Models\store;

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
            ->addColumn('action', function($model){
                $action = '<a href="javascript:void(0)" data-category_id="'.$model->id.'" data-url="'.route('admin.app_status.edit',["$model->id"]).'" data-toggle="modal" data-target="#statusmodel" class="btn btn-sm btn-info" id="trigger-content-'.$model->id.'" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;';
                $action .= '<button class="btn btn-sm btn-danger btn-delete" type="button" data-delete-route="'.route('admin.app_status.destroy', $model->id).'" data-redirect="'.route('admin.app_status.index').'" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>';

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
            'user_id', 'app_statuses_id', 'first_name', 'middle_name', 'last_name', 'photo',
            'phone', 'aadhar', 'aadhar_image', 'driving_licence', 'driving_licence_image',
            'address', 'area', 'state', 'city',	'pincode', 'bank_name', 'bank_account_number',
            'ifsc', 'area_mapping_state', 'area_mapping_area', 'area_mapping_city', 'area_mapping_pincode'
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
