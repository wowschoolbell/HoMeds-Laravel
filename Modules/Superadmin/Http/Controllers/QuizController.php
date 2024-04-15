<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Superadmin\DataTables\UserDataTable;

class QuizController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = User::class;
    public $viewfolder = "quizzes";

    protected function _validation_rules($request, $id = null)
    {
        $rules['type']     = "required";
        $rules['question'] = "required";
        $rules['course'] = "required";
        $rules['point']    = "required|numeric|not_in:0";

        if ($request->type == 'mf') {
            $rules['question_title'] = "required";
            $rules['answer_title'] = "required";
            $rules['quiz_option.*.question'] = "required|distinct";
            $rules['quiz_option.*.answer'] = "required|distinct";
            $rules['quiz_option.*.shuffle_answer'] = "required|distinct";
        } else {
            $rules['quiz_option.0.is_correct']    = function ($attribute, $value, $fail) use ($request) {
                $isCorrect = collect($request->quiz_option)->where('is_correct', 1)->toArray();
    
                if (empty($isCorrect)) {
                    $fail('Choose the correct options.');
                }
            };
            $rules['quiz_option.*.option'] = "required|distinct";
        }
        

        return $rules;
    }

    /**
     * 
     */
    protected function _validation_messages($request)
    {
        $messages['question.required'] = 'The question field is required.';
        $messages['question.max']      = 'The question may not be greater than 255 characters.';
        $messages['type.required']     = 'The question type field is required.';

        $r_key = 1;
        foreach(request()->quiz_option ? : [] as $key => $option)
        {
            $messages['quiz_option.'.($key).'.option.required'] = 'Option field is required in Row '.($r_key);
            $r_key++;
        }


        $d_key = 1;
        foreach(request()->quiz_option ? : [] as $key => $option)
        {
            $messages['quiz_option.'.($key).'.option.distinct'] = 'Option field is duplicate in Row '.($d_key);
            $d_key++;
        }

        $messages['point.required']    = 'The point field is required.';
        $messages['point.numeric']     = 'The point field must be number.';
        $messages['point.not_in']      = 'The point field must not be 0.';

        return $messages;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(UserDataTable $dataTable)
    {
        $data['quizzes'] = app('firebase.firestore')->database()
            ->collection('quizzes')
            ->where('course', '==', @request()->course_id)
            ->documents();
        
        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.index", $data);
    }

    /**
     * 
     */
    public function create()
    {
        $data = [];
        $data['title'] = 'Create Quiz';
        $data['course'] = @request()->course_id;
        $this->_append_variables(null, $data);

        return view("{$this->modulename}::{$this->viewfolder}.create", $data);
    }

    /**
     * 
     */
    public function edit($id)
    {
        $data           = [];
        $data['title']  = 'Edit Quiz';
        $data['id']     = $id;
        $data['course'] = @request()->course_id;
        $this->_append_variables($id, $data);
        
        return view("{$this->modulename}::{$this->viewfolder}.edit", $data);
    }

    protected function _append_variables($id = null, &$data)
    {
        $data['courses'] = [];

        $courses = app('firebase.firestore')->database()->collection('courses')->documents();

        foreach($courses as $course)
        {
            $data['courses'][$course->id()] = $course->data()['title'];
        }

      //$data['curriculams'] = [];

        $data['questionTypes'] = [
            'si'    => 'Single Choice',
            'mu'    => 'Multiple Choice',
            'mf'    => 'Drag n Drop',
        ];
        $data['type']           = 'si';
        if ($id) {

            $data['quiz'] = app('firebase.firestore')->database()->collection('quizzes')->document($id)->snapshot();
            $data['type']           = $data['quiz']->data()['type'];
            $data['question']       = $data['quiz']->data()['question'];
            $data['course']         = $data['quiz']->data()['course'];
            $data['point']          = $data['quiz']->data()['point'];
            $data['question_title'] = @$data['quiz']->data()['question_title'];
            $data['answer_title']   = @$data['quiz']->data()['answer_title'];
            $data['wrong_answer_feedback']   = @$data['quiz']->data()['wrong_answer_feedback'];
            $data['right_answer_feedback']   = @$data['quiz']->data()['right_answer_feedback'];
            $data['quizOptions']    = $data['quiz']->data()['quiz_option'];
        }

        $course = app('firebase.firestore')->database()->collection('courses')->document($data['course'])->snapshot();
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            $this->_validation_rules($request),
            $this->_validation_messages($request)
        );

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }
        
        $documentId = User::generateRandomString();
        $quiz = app('firebase.firestore')->database()->collection('quizzes')->document($documentId);
        $quiz->set($request->all());

        return response()->json([
            'success' => true,
            'title' => 'Quiz',
            'message' => 'Created Successfully!!!',
            'redirect' => route("sa.quizzes.index").'?course_id='.$request->course,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            $this->_validation_rules($request),
            $this->_validation_messages($request)
        );

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }

        app('firebase.firestore')->database()->collection('quizzes')->document($id)->delete();
        $quiz = app('firebase.firestore')->database()->collection('quizzes')->document(mt_rand(1000000000, 9999999999));
        $quiz->set($request->all());

        return response()->json([
            'success' => true,
            'title' => 'Quiz',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.quizzes.index").'?course_id='.$request->course,
        ], 200);

    }

    /**
     * 
     */
    public function curriculam(Request $request)
    {
        $data = [];
        $course = app('firebase.firestore')->database()->collection('courses')->document($request->course_id)->snapshot();

        $curriculams = $course->data()['curriculum'];

        foreach($curriculams as $curriculam)
        {
            $data[$curriculam['title']] = $curriculam['title'];
        }

        return $data;
    }

    public function option(Request $request)
    {
        $data['key']    = $request->get('row');
        if($request->type == 'si') {
            return view("{$this->modulename}::{$this->viewfolder}.partials.quiz_single_option", $data);
        } elseif ($request->type == 'mu') {
            return view("{$this->modulename}::{$this->viewfolder}.partials.quiz_multiple_option", $data);
        } elseif ($request->type == 'mf') {
            return view("{$this->modulename}::{$this->viewfolder}.partials.quiz_match_following", $data);
        }
    }

    /**
     * 
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('quizzes')->document($id)->delete();
    }

}
