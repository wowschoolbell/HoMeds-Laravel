<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Superadmin\DataTables\UserDataTable;

class UserController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = User::class;
    public $viewfolder = "users";

    protected function _validation_rules($request, $id = null)
    {
        return [
            'first_name'            => ['required'],
            'last_name'             => ['required'],
            'organization'          => ['required'],
            'gender'                => ['required'],
            'age_group'             => ['required'],
            'username'              => ['required'],
            'password'              => ['required'],
            'email'                 => ['required'],
            'city'                  => ['required'],
            'state'                 => ['required'],
            'experience_level'      => ['required'],
            'mobile_number'         => ['required'],
            'topics_of_interests.*.name'   => ['required'],

        ];
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(UserDataTable $dataTable)
    {
        $data['users'] = app('firebase.firestore')->database()->collection('users')->documents();
        
        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index", $data);
    }

    /**
     * 
     */
    public function create()
    {
        $data = [];

        $this->_append_variables($data);

        return view("{$this->modulename}::{$this->viewfolder}.create", $data);
    }

    /**
     * 
     */
    protected function _append_variables(&$data, $id = null)
    {
        $data['genders'] = [
            'Male'      => 'Male',
            'Female'    => 'Female',
        ];

        $data['age_groups'] = [
            '18 to 21 years'    => '18 to 21 years',
            '22 to 31 years'    => '22 to 31 years',
            '32 to 41 years'    => '32 to 41 years',
            '42 to 51 years'    => '42 to 51 years',

        ];

        $data['states'] = [
            'TamilNadu'      => 'TamilNadu',
            'Karnataka'    => 'Karnataka',
        ];

        $data['experience_levels'] = [
            'Student'      => 'Student',
            'Workforce'    => 'Workforce',
            'Professional'    => 'Professional',
            'Self-employed'    => 'Self-employed',
        ];
        
        if ($data['id'] = $id) {
            $user = app('firebase.firestore')->database()
                ->collection('users')->document($data['id'])
                ->snapshot();
            
            $topicOfInterests = $user->data()['topics_of_interest'];
            foreach($topicOfInterests as $topicOfInterest)
            {
                $data['topics_of_interests'][] = [
                    'name'  => $topicOfInterest['name']
                ];
            }
            $data['age_group']          = @$user->data()['age_group'];
            $data['city']               = @$user->data()['city'];
            $data['state']              = @$user->data()['state'];
            $data['email']              = @$user->data()['email'];
            $data['experience_level']   = @$user->data()['experience_level'];
            $data['first_name']         = @$user->data()['first_name'];
            $data['last_name']          = @$user->data()['last_name'];
            $data['mobile_number']      = @$user->data()['mobile_number'];
            $data['gender']             = @$user->data()['gender'];
            $data['organization']       = @$user->data()['organization'];
            $data['password']           = @$user->data()['password'];
            $data['username']           = @$user->data()['username'];
        } else {
            $data['topics_of_interests'] = [null];
        }
    }

    /**
     * 
     */
    public function edit($id)
    {
        $data = [];

        $this->_append_variables($data, $id);

        return view("{$this->modulename}::{$this->viewfolder}.edit", $data);
    }

    /**
     * 
     */
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
        $user = app('firebase.firestore')->database()->collection('users')->document($documentId);
        $user->set($request->all());
        
        return response()->json([
            'success' => true,
            'title' => 'User',
            'message' => 'Created Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);
    }

    /**
     * 
     */
    public function update(Request $request, $documentId)
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

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[] = [
                    'path'  => $key,
                    'value' => $value,
                ];
            }
        }

        $user = app('firebase.firestore')->database()->collection('users')->document($documentId);
        $user->set($request->all());
        
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
        app('firebase.firestore')->database()->collection('users')->document($id)->delete();
    }


}
