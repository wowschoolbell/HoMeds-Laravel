<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AppStatusDataTable;
use App\Http\Controllers\Controller;
use App\Models\AppStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppStatusController extends Controller
{
    public function index(AppStatusDataTable $dataTable)
    {
        return $dataTable->render('admin.app_status.index');
    }

    public function create() 
    {
        $data['model'] = [
            'app_status' => new AppStatus()
        ];

        $data['title']      = 'Add App Status';
        $data['route']      = 'admin.app_status.store';
        $data['method']     = 'post';

        return view('admin.app_status.partials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new AppStatus();
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'App Status',
            'message' => 'Successfully created ',
            'redirect' => route("admin.app_status.index"),
        ], 200);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['model'] = [
            'category' => AppStatus::findOrFail($id)
        ];

        $data['title']      = 'Edit Category';
        $data['route']      = 'admin.app_status.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;
        $this->_append_variables($data, $id);

        return view('admin.app_status.partials.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = AppStatus::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'App Status',
            'message' => 'Successfully updated',
            'redirect' => route("admin.app_status.index"),
        ], 200);
    }


    protected function _save($request, $model)
    {
        $model->fill($request->get('app_status'));
        $model->save();
    }

}
