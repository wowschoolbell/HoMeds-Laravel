<?php

namespace Modules\Superadmin\Http\Controllers;

use Modules\Superadmin\DataTables\CourseCategoryDataTable;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
{
    public $modulename = 'superadmin';
    public $viewfolder = 'coursecategories';

    protected function _validation_rules($request, $id)
    {
        return [
            'name' => ['required'],
        ];
    }

    public function index(CourseCategoryDataTable $dataTable)
    {
        $data['categories'] = app('firebase.firestore')->database()->collection('course categories')->documents();

        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index", $data);
    }

    public function create()
    {
        $data['routename'] = "sa.course_categories.store";
        $data['id'] = NULL;
        $data['method'] = "POST";
        $data['title'] = "Create Course Category";

        return view("{$this->modulename}::{$this->viewfolder}.form_popup", $data);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->_validation_rules($request, Null));
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors()),
            ], 422);
        }

        $documentId = User::generateRandomString();
        $category   = app('firebase.firestore')->database()->collection('course categories')->document($documentId);

        $category->set([
            'name' => $request->name,
        ]);
        
        return response()->json([
            'success' => true,
            'title' => 'Category',
            'message' => 'Created Successfully!!!',
            'redirect' => route("sa.course_categories.index"),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['routename']  = "sa.course_categories.update";
        $data['id']         = $id;
        $data['method']     = "PUT";
        $data['title']      = "Edit Course Category";

        $category           = app('firebase.firestore')->database()->collection('course categories')->document($id)->snapshot();
        $data['name']    = $category->data()['name'];

        return view("{$this->modulename}::{$this->viewfolder}.form_popup", $data);
    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), $this->_validation_rules($request, $id));
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors()),
            ], 422);
        }
        
        $category = app('firebase.firestore')->database()->collection('course categories')->document($id);
        $category->update([
            [
                'path'  => 'name',
                'value' => $request->name
            ]
        ]);

        return response()->json([
            'success' => true,
            'title' => 'Category',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.course_categories.index"),
        ], 200);
    }

    /**
     * 
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('course categories')->document($id)->delete();
    }
}
