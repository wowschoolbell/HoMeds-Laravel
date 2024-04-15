<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\SubCourseCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Superadmin\DataTables\SubCourseCategoryDataTable;

class SubCourseCategoryController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = SubCourseCategory::class;
    public $viewfolder = 'sub_course_categories';

    protected function _validation_rules($request, $id)
    {
        return [
            'name'          => ['required'],
            'category_id'   => ['required'],
        ];
    }

    public function index(SubCourseCategoryDataTable $dataTable)
    {
        $data['categories'] = app('firebase.firestore')->database()->collection('course sub categories')->documents();

        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index", $data);
    }

    public function create()
    {
        $data['routename'] = "sa.sub_course_categories.store";
        $data['id'] = NULL;
        $data['method'] = "POST";
        $data['title'] = "Create Sub Course Category";
        
        $this->_append_variables($data);
        $data['category_id']    = @request()->category;

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

        $data = $request->except(['_token']);
        if ($thumbnail = $request->file('thumbnail')) {
            $thumbnailPath = StorageHelper::uploadFileAs($thumbnail, 'repository/course_categories');
            $data['thumbnail'] =  $thumbnailPath;
        }

        $documentId = User::generateRandomString();
        $user = app('firebase.firestore')->database()->collection('course sub categories')->document($documentId);
        $user->set($data);

        return response()->json([
            'success' => true,
            'title' => 'Sub Category',
            'message' => 'Created Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index").'?category='.$request->category_id
        ], 200);
                
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['routename'] = "sa.sub_course_categories.update";
        $data['id'] = $id;
        $data['method'] = "PUT";
        $data['title'] = "Edit Sub Course Category";
        $data['category_id']    = @request()->category;

        $this->_append_variables($data, $id);

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
        $validation = Validator::make($request->all(), $this->_validation_rules($request, $id));
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors()),
            ], 422);
        }
        
        $category = app('firebase.firestore')->database()->collection('course sub categories')->document($id);
        $category->update([
            [
                'path'  => 'name',
                'value' => $request->name
            ], [
                'path'  => 'category_id',
                'value' => $request->category_id
            ]
        ]);

        if ($thumbnail = $request->file('thumbnail')) {
            $thumbnailPath = StorageHelper::uploadFileAs($thumbnail, 'repository/course_categories');
            $data['thumbnail'] =  $thumbnailPath;

            $category->update([
                [
                    'path'  => 'thumbnail',
                    'value' => $thumbnailPath
                ]
            ]);
        }

        return response()->json([
            'success' => true,
            'title' => 'Sub Category',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index").'?category='.$request->category_id
        ], 200);
    }

    public function courseCategory(Request $request)
    {
        if ($categoryId = $request->category_id) {

            $categories = app('firebase.firestore')->database()->collection('course sub categories')->documents();
            $data['categories'] = [];
            foreach($categories as $category)
            {
                if ($category->data()['category_id'] == $categoryId) {
                    $data['categories'][$category->id()] = $category->data()['name'];
                }
                
            }
            return $data['categories'];
        } else {
            return [];
        }
    }

    protected function _append_variables(&$data, $id = null)
    {
        $data ['sub_categories'] =  ['Video'  =>  'Video', 
       'Podcast'   => 'Podcast', 'Nuggets'   => 'Nuggets', 'Microlearnings'   => 'Microlearnings'];
        $categories = app('firebase.firestore')->database()->collection('course categories')->documents();
        $data['course_categories'] = [];
        foreach($categories as $category)
        {
            $data['course_categories'][$category->id()] = $category->data()['name'];
        }

        if ($id) {
            $subCategory = app('firebase.firestore')->database()
                ->collection('course sub categories')->document($data['id'])
                ->snapshot();
            $data['name']           = @$subCategory->data()['name'];
            $data['thumbnail']      = @$subCategory->data()['thumbnail'];
        }
    }

    /**
     * 
     */
    public function destroy($id)
    {
        $courseCount = Course::coursesCountBasedOnSubCategory($id);

        if ($courseCount->size() != 0) {
            return response()->json([
                'success' => false,
                'message' => "You can't delete the category. Beacuase this category assigned to some courses. ",
            ], 422);
        }

        app('firebase.firestore')->database()->collection('course sub categories')->document($id)->delete();
    }
}
