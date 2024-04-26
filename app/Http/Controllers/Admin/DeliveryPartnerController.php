<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryPartnerDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoreDataTable;
use App\Models\AppStatus;
use App\Models\DeliveryPartner;
use App\Models\store;
use App\User;
use Illuminate\Support\Facades\Validator;

class DeliveryPartnerController extends Controller
{
    public function index(DeliveryPartnerDataTable $dataTable)
    {
        $data['title'] = 'Delivery Partner';
        return $dataTable->render('admin.delivery_partner.index', $data);
    }
    public function create() 
    {
        $data['model'] = [
            'delivery_partner' => new DeliveryPartner(),
        ];

        $data['title']      = 'Add Delivery Partner';
        $data['statuses']   = AppStatus::pluck('name', 'id');
        

        return view('admin.delivery_partner.create', $data);
    }
    public function store(Request $request)
    {
        dd($request->all());
        $model = new User();
        $this->_save_user($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'Store Status',
            'message' => 'Successfully created ',
            'redirect' => route("admin.store.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $data['model'] = [
            'category' => store::findOrFail($id)
        ];
        
        dd($data);

        $data['title']      = 'Edit store';
        $data['route']      = 'admin.store.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;
        $this->_append_variables($data, $id);

        return view('admin.store.partials.form', $data);
    }
     public function update(Request $request, $id)
    {
        $model = store::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'Store',
            'message' => 'Successfully updated',
            'redirect' => route("admin.store.index"),
        ], 200);
    }
    protected function _save($request, $model)
    {
        $model->fill($request->get('store'));
        $model->save();
    }

    protected function _save_user($request, $model)
    {
        $model->fill($request->get('user'));
        $model->save();
    }

    
}
