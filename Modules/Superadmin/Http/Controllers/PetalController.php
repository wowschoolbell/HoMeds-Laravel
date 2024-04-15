<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Helpers\StorageHelper;
use Modules\Superadmin\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetalController extends Controller
{
    public $modulename = 'superadmin';
    public $viewfolder = "petals";

    protected function _petal_details($request, &$data)
    {

        $data['name'] = $request->name;
        $data['course_id'] = $request->course_id;
        $data['about'] = $request->about;
        foreach($request->related_courses as $key => $relatedCourse) {
            $data['related_courses'][$key]['_id'] = $relatedCourse;
        }
        $data['intro_video'] = $request->intro_video;
        foreach($request->related_podcasts as $key => $relatedPodcast) {
            $data['related_podcasts'][$key]['_id'] = $relatedPodcast;
        }
        $data['faq'] = $request->faq;
        $data['resources'] = $request->resources;
        $data['announcements'] = [];
        foreach ($request->announcements as $key => $announcement) {
            $data['announcements'][$key]['date'] = $announcement['date'];

            if (is_file($announcement['image'])) {
                $thumbnailPath = StorageHelper::uploadFileAs($announcement['image'], 'repository/petals');
                $data['announcements'][$key]['image'] = $thumbnailPath;
            } else {
                $data['announcements'][$key]['image'] = $announcement['image'];
            }
        }

    }

    protected function _validation_rules($request, $id = null)
    {

        $rules['name']  = ['required'];
        $rules['course_id']  = ['required'];
        $rules['about']  = ['required'];
        $rules['related_courses']  = 'required|array';
        $rules['intro_video']  = 'required';
        $rules['related_podcasts']  = 'required|array';
        $rules['announcements.*.date']  = ['required'];

        if (!$id) {
            $rules['announcements.*.image']  = ['required'];
        }
        $rules['faq.*.question']  = ['required'];
        $rules['faq.*.answer']  = ['required'];
        $rules['resources.*.name']  = ['required'];
        $rules['resources.*.url']  = ['required'];
            
        return $rules;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(CourseDataTable $dataTable)
    {
        $data['petals'] = app('firebase.firestore')->database()->collection('petals')->documents();

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
        
        $data['faqs'] = $data['announcements'] = $data['resources'] = [1];
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
        $courses = app('firebase.firestore')->database()->collection('courses')->documents();
        
        $data['courses'] = [];
        foreach($courses as $course)
        {
            $data['courses'][$course->id()] = $course->data()['title'];
        }

        if ($data['id'] = $id) {

            $petal = app('firebase.firestore')->database()->collection('petals')->document($id)->snapshot();
        
            $data['name'] = @$petal->data()['name'];
            $data['course_id'] = @$petal->data()['course_id'];
            $data['about'] = @$petal->data()['about'];
            $data['related_courses'] =[];
            foreach( @$petal->data()['related_courses'] as  $relatedCources) {
                foreach($relatedCources as $relatedCource) {
                    array_push($data['related_courses'], $relatedCource);
                }
            }
            $data['related_podcasts'] =[];
            foreach( @$petal->data()['related_podcasts'] as  $relatedPodcasts) {
                foreach($relatedPodcasts as $relatedPodcast) {
                    array_push($data['related_podcasts'], $relatedPodcast);
                }
            }
            
            $data['faqs'] = @$petal->data()['faq'];
            $data['announcements'] = @$petal->data()['announcements'];
            $data['resources'] = @$petal->data()['resources'];
            $data['intro_video'] = @$petal->data()['intro_video'];
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
        $this->_petal_details($request, $data);
        $data['created_at'] = Carbon::now();
        $documentId = User::generateRandomString();
        $petal = app('firebase.firestore')->database()->collection('petals')->document($documentId);
        $petal->set($data);
        
        return response()->json([
            'success' => true,
            'title' => 'Petal',
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
        $this->_petal_details($request, $data);

        app('firebase.firestore')->database()->collection('petals')->document($id);

        return response()->json([
            'success' => true,
            'title' => 'Petal',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);
    }

    /**
     * 
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('petals')->document($id)->delete();
    }

}
