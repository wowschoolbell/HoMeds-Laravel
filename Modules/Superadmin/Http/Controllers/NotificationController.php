<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Superadmin\DataTables\UserDataTable;

class NotificationController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = User::class;
    public $viewfolder = "notifications";

    protected function _validation_rules($request, $id = null)
    {
        $rules['content']     = "required";
        return $rules;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(UserDataTable $dataTable)
    {
        $data['notifications'] = app('firebase.firestore')->database()->collection('push notifications')->documents();
        
        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index", $data);
    }

    /**
     * 
     */
    public function create()
    {
        $data['title']      = 'Create Notification';
        $data['route']      = 'sa.notifications.store';
        $data['routeIds']   = null;
        $data['method']     = 'POST';

        return view("{$this->modulename}::{$this->viewfolder}.partials.form", $data);
    }

    /**
     * 
     */
    public function edit($id)
    {
        $data['title']      = 'Edit Notification';
        $data['route']      = 'sa.notifications.update';
        $data['routeIds']   = $id;
        $data['method']     = 'PUT';

        $notification = app('firebase.firestore')->database()->collection('push notifications')->document($id)->snapshot();

        $data['content']    = $notification->data()['text'];

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
        
        $documentId = User::generateRandomString();
        $notification = app('firebase.firestore')->database()->collection('push notifications')->document($documentId);
        $notification->set([
            'createdAt' => Carbon::now(),
            'text' => $request->content,
            'user' => [ 'name' => Auth::user()->name],
        ]);

        return response()->json([
            'success' => true,
            'title' => 'Notification',
            'message' => 'Created Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);
    }

    public function update(Request $request, $id)
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

        $notification = app('firebase.firestore')->database()->collection('push notifications')->document($id);
        $notification->update([
            [
                'path'  => 'text',
                'value' => $request->content
            ]
        ]);

        return response()->json([
            'success' => true,
            'title' => 'Notification',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);

    }

    /**
     * 
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('push notifications')->document($id)->delete();
    }

}
