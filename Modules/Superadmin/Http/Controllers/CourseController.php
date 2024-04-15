<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Helpers\StorageHelper;
use Modules\Superadmin\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Course;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = Course::class;
    public $viewfolder = "courses";

    protected function _course_details($request, &$data)
    {
        if ($request->title)
            $data['title'] = $request->title;
        if ($request->author)
            $data['author'] = $request->author;
        if ($request->category_id)
            $data['category_id'] = $request->category_id;
        if ($request->sub_category_id)
            $data['sub_category_id'] = $request->sub_category_id;
        if ($request->video_hours)
            $data['video_hours'] = $request->video_hours;
        if ($request->quizzes)
            $data['quizzes'] = $request->quizzes;
        if ($request->assignments)
            $data['assignments'] = $request->assignments;
        if ($request->course_id)
            $data['course_id'] = $request->course_id;

        if ($request->language) {
            $data['language'] = explode(',', $request->language);
        }

        if ($request->cc_language) {
            $data['cc_language'] = explode(',', $request->cc_language);
        }

        if ($request->description)
            $data['description'] = $request->description;
        if ($request->course_items)
            $data['course_items'] = $request->course_items;
        if ($request->benefits['0']['data'])
            $data['benefits'] = $request->benefits;
        if ($request->tags)
            $data['tags'] = $request->tags;
        // $data['curriculum'] = $request->curriculum;
        if (@$request->faq[0]['question'])
            $data['faq'] = $request->faq;
        if (@$request->faq[0]['question'])
            $data['faq'] = $request->faq;
        if ($request->tags)
            $data['tags'] = $request->tags;
        if ($request->sections['0']['section_name']) {
            $data['sections'] = $request->sections;
            

            foreach ($data['sections'] as $key => $sections) {
                foreach($sections['details'] as $s_key => $section) {
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $section['video_link'], $match);
                    $data['sections'][$key]['details'][$s_key]['time'] = $section['section_minute'] * 60;
                    $data['sections'][$key]['details'][$s_key]['sno']   = (integer) $section['sno'];
                    $data['sections'][$key]['details'][$s_key]['video_id'] = $match[1];
                    $data['sections'][$key]['details'][$s_key]['video_link'] = @$request->sections[$key]['details'][$s_key]['video_link'];
                }
            } 
        }
            

        $data['last_updated'] = Carbon::now();

        if ($image = $request->file('image')) {
            $thumbnailPath = StorageHelper::uploadFileAs($image, 'repository/courses');
            $data['image'] =  $thumbnailPath;
        }

        $data['created_by'] = Auth::user()->id;
    }

    protected function _validation_rules($request, $id = null)
    {
        $data = [
            'title'                         => ['required'],
           // 'course'                        => ['required'],
            'category_id'                   => ['required'],
            'sub_category_id'               => ['required'],
           // 'video_hours'                   => ['required'],
           // 'quizzes'                       => ['required'],
            //'assignments'                   => ['required'],
            'language'                      => ['required'],
            'cc_language'                   => ['required'],
            'description'                   => ['required'],
            'course_items'                  => ['required'],
            'tags'                          => ['required'],
            // 'curriculum.*.title'            => ['required'],
            // 'curriculam.*.link'             => ['required'],
            'benefits.*.data'               => ['required'],
            //'faq.*.answer'                  => ['required'],
            //'faq.*.question'                => ['required'],
            'sections.*.section_name'       => ['required'],
            'sections.*.section_number'     => ['required'],
            'sections.*.details.*.title'    => ['required'],
            'sections.*.details.*.video_link' => ['required'],
            //'sections.*.details.*.time'     => ['required'],
            'author'                        => ['required'],
        ];

        if (!$id) {
            $data['image'] = ['required'];
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(CourseDataTable $dataTable)
    {
        $categories = app('firebase.firestore')->database()->collection('course categories')->documents();
        $data['categories'] = [];
        foreach($categories as $category)
        {
            $data['categories'][$category->id()] = $category->data()['name'];
        }
        
        $data['courses'] = app('firebase.firestore')->database()->collection('courses');

        if ($subCategory = @request()->sub_course_category) {

            $data['courses'] = $data['courses']->where('sub_category_id', '==',  $subCategory);
            }
            
            $data['courses'] = $data['courses']->documents();

        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index", $data);
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function create()
    {
        $data = [];
        $this->_append_variables($data);
        
        // $data['curriculums'] = 
        $data['benefits'] = $data['faqs'] = $data['sections'] = [1];
        $data['subCategories'] = [];

        return view("{$this->modulename}::{$this->viewfolder}.create", $data);
    }

    public function edit($id)
    {
        $data = [];
        $this->_append_variables($data, $id);

        return view("{$this->modulename}::{$this->viewfolder}.edit", $data);
    }

    public function show($id)
    {
        $data = [];
        $this->_append_variables($data, $id);

        return view("{$this->modulename}::{$this->viewfolder}.show", $data);
    }

    protected function _append_variables(&$data, $id = null)
    {
        $categories = app('firebase.firestore')->database()->collection('course categories')->documents();
        $courses = app('firebase.firestore')->database()->collection('courses')->documents();
        
        $data['courses'] = $data['categories'] = [];
        foreach($courses as $course)
        {
            $data['courses'][$course->id()] = $course->data()['title'];
        }
        
        foreach($categories as $category)
        {
            $data['categories'][$category->id()] = $category->data()['name'];
        }

        for($i=0; $i<=12; $i++){
            if (strlen($i) == 1) {
                $data['hours'][$i] = sprintf("%02d", $i);
            } else {
                $data['hours'][$i] = $i;
            }
        }
        for($i=0; $i<=60; $i++){
            if (strlen($i) == 1) {
                $data['minutes'][$i] = sprintf("%02d", $i);
            } else {
                $data['minutes'][$i] = $i;
            }
        }
        for($i=0; $i<=60; $i++){
            if (strlen($i) == 1) {
                $data['seconds'][$i] = sprintf("%02d", $i);
            } else {
                $data['seconds'][$i] = $i;
            }
        }

        $data['selectedCourseItems'] = [
            "Video"             => "Video",
            "Podcast"           => "Podcast",
            "Nuggets"           => "Nuggets",
            "Microlearnings"    => "Microlearnings",
        ];
        if ($data['id'] = $id) {

            $course = app('firebase.firestore')->database()->collection('courses')->document($id)->snapshot();
            $categories = app('firebase.firestore')->database()->collection('course sub categories')->documents();
            $data['subCategories'] = [];
            foreach($categories as $category)
            {
                if ($category->data()['category_id'] == $course->data()['category_id']) {
                    $data['subCategories'][$category->id()] = $category->data()['name'];
                }
            }
        
            $category = app('firebase.firestore')->database()->collection('course categories')->document($course->data()['category_id'])->snapshot();
            $data['categoryName'] = $category->data()['name'];
            $subCategory = app('firebase.firestore')->database()->collection('course sub categories')->document($course->data()['sub_category_id'])->snapshot();
            $data['subCategoryName'] = @$subCategory->data()['name'];

            $data['title'] = @$course->data()['title'];
            $data['author'] = @$course->data()['author'];
            $data['category_id'] = @$course->data()['category_id'];
            $data['sub_category_id'] = @$course->data()['sub_category_id'];
            $data['video_hours'] = @$course->data()['video_hours'];
            $data['quizzes'] = @$course->data()['quizzes'];
            $data['assignments'] = @$course->data()['assignments'];
            $data['language'] = implode(',', @$course->data()['language']);
            $data['cc_language'] = implode(',', @$course->data()['cc_language']);
            $data['description'] = @$course->data()['description'];
            $data['course_items'] = @$course->data()['course_items'];
            $data['benefits'] = @$course->data()['benefits'];
            $data['course'] = @$course->data()['course'];
            // $data['curriculums'] = $course->data()['curriculum'];
            $data['faqs'] = @$course->data()['faq'];
            $data['sections'] = @$course->data()['sections'];
            $data['last_updated'] = @$course->data()['last_updated'];
            $data['image'] =  @$course->data()['image'];
            $data['tags'] =  @$course->data()['tags'];
        }
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

        $data = [];
        $this->_course_details($request, $data);
        $data['users_enrolled']  = [];
        $data['backend_user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        $documentId = User::generateRandomString();
        $data['course'] = $documentId;
        $course = app('firebase.firestore')->database()->collection('courses')->document($documentId);
        $course->set($data);
        
        return response()->json([
            'success' => true,
            'title' => 'Course',
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

        $data = [];
        $this->_course_details($request, $data);
        $data['course'] = $id;
        foreach ($data as $key => $value) {
            if ($value) {
                $courseValues[] = [
                    'path'  => $key,
                    'value' => $value,
                ];
            }
        }

        $course = app('firebase.firestore')->database()->collection('courses')->document($id);
        $course->update($courseValues);

        return response()->json([
            'success' => true,
            'title' => 'Course',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $course = Course::find($request->id);
        $course->status = $request->active;
        $course->save();

        return $course;
    }

    protected function _save($request, $model)
    {
        $data = $request->except(['_token']);
        $data['status'] = Course::APPROVED;

        if (!$model->user_id) {
            $data['user_id'] = Auth::user()->id;
        }
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * 
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('courses')->document($id)->delete();
    }

    public function addparticular(Request $request)
    {
        $data['ptkey'] = $request->get('ptrow');
        $data['model'] = [
            'applicables' => [collect()]
        ];
        for($i=0; $i<=60; $i++){
            if (strlen($i) == 1) {
                $data['minutes'][$i] = sprintf("%02d", $i);
            } else {
                $data['minutes'][$i] = $i;
            }
        }
        $returnHTML = view("{$this->modulename}::{$this->viewfolder}.partials.section", $data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function addaccess(Request $request)
    {
        for($i=0; $i<=12; $i++){
            if (strlen($i) == 1) {
                $data['hours'][$i] = sprintf("%02d", $i);
            } else {
                $data['hours'][$i] = $i;
            }
        }
        for($i=0; $i<=60; $i++){
            if (strlen($i) == 1) {
                $data['minutes'][$i] = sprintf("%02d", $i);
            } else {
                $data['minutes'][$i] = $i;
            }
        }
        for($i=0; $i<=60; $i++){
            if (strlen($i) == 1) {
                $data['seconds'][$i] = sprintf("%02d", $i);
            } else {
                $data['seconds'][$i] = $i;
            }
        }
        $data['ptkey'] = $request->get('ptrow');
        $data['ackey'] = $request->get('acrow');
        $returnHTML = view("{$this->modulename}::{$this->viewfolder}.partials.access", $data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
