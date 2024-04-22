<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoreDataTable;
use App\Models\store;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index(StoreDataTable $dataTable)
    {
        return $dataTable->render('admin.store.index');
    }
    public function create() 
    {
        $data['model'] = [
            'store' => new store()
        ];

        $data['title']      = 'Add Store';
        $data['route']      = 'admin.store.store';
        $data['method']     = 'post';

        return view('admin.store.partials.form', $data);
    }
    public function store(Request $request)
    {
        $model = new store();
        $this->_save($request, $model);

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
}
