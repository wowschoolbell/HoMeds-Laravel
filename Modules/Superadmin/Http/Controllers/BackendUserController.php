<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Superadmin\DataTables\UserDataTable;
use Modules\Superadmin\Entities\Role;

class BackendUserController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = User::class;
    public $viewfolder = "backend_users";

    protected function _validation_rules($request, $id = null)
    {
        $rules['name']     = "required";
        $rules['email']     = "required";

        if (!$id) {
            $rules['password']     = "required";
        }
        return $rules;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index");
    }

    /**
     * 
     */
    public function create()
    {
        $data['model']      = new User();
        $data['title']      = 'Create User';
        $data['route']      = 'sa.backend_users.store';
        $data['routeIds']   = null;
        $data['method']     = 'POST';
        $data['roles']      = ['Super user' => 'Super user',
            'Viewer' => 'Viewer'];

        return view("{$this->modulename}::{$this->viewfolder}.partials.form", $data);
    }

    /**
     * 
     */
    public function edit($id)
    {
        $data['model']      = User::find($id);
        $data['title']      = 'Edit User';
        $data['route']      = 'sa.backend_users.update';
        $data['routeIds']   = $id;
        $data['method']     = 'PUT';
        $data['roles']      = ['Super user' => 'Super user',
            'Viewer' => 'Viewer'];
        $data['role']       = @$data['model']->allRoles()[0];

        return view("{$this->modulename}::{$this->viewfolder}.partials.form", $data);
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            $this->_validation_rules($request),
        );

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }
        
        $model = new User();
        $model = $this->_save_user($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'User',
            'message' => 'Created Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            $this->_validation_rules($request, $id),
        );

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }

        $model = User::find($id);
        $this->_save_user($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'User',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);

    }

    /**
     * 
     */
    public function destroy($id)
    {
        user::find($id)->delete();
    }

    /**
     * 
     */
    protected function _save_user($request, $model) {

        $model->name = $request->name;
        $model->email = $request->email;
        if ($password = $request->password)
        {
            $model->password = Hash::make($password);
        }

        $model->save();

        $model->syncRoles([$request->role]);

        return $model;        
    }

}
