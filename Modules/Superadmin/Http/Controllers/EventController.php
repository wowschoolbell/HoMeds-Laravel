<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Event;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Superadmin\DataTables\EventDataTable;
use Modules\Superadmin\DataTables\UserDataTable;

class EventController extends Controller
{
    public $modulename = 'superadmin';
    public $modelclass = Event::class;
    public $viewfolder = "events";

    protected function _validation_rules($request, $id = null)
    {

        $data = [
            'title'                 => ['required'],
            'category_id'           => ['required'],
            'recommended_course'    => ['required'],
            'start_date'            => ['required'],
            

            //'benefits_one.title'        => ['required'],
            //'benefits_one.subtitle'     => ['required'],
            //'benefits_one.description'  => ['required'],

            //'benefits_two.title'        => ['required'],
            //'benefits_two.description'  => ['required'],

            'speaker.name'              => ['required'],
            'speaker.description'       => ['required'],
            'speaker.linked_in_link'   => ['required'],
            
            'weblink.name'          => ['required'],
            'weblink.link'          => ['required'],

            //'address'               => ['required'],
            //'link'                  => ['required'],
            //'venue'                 => ['required'],
        ];

        if ($request->location == 'Physical') {
            $data['location_address'] = ['required'];
        } else if ($request->location == 'Online') {
            $data['location_link'] = ['required'];
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index(Request $request, EventDataTable $dataTable)
    {
        $categories = app('firebase.firestore')->database()->collection('event categories')->documents();
        $data['categories'] = [];
        foreach($categories as $category)
        {
            $data['categories'][$category->id()] = $category->data()['name'];
        }
        
        $data['events'] = app('firebase.firestore')->database()->collection('events');
        
        if ($request->category) {
            $data['events'] = $data['events']->where('category_id', '==', @$request->category);
        }
        $data['events'] = $data['events']->documents();

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
        $categories = app('firebase.firestore')->database()->collection('event categories')->documents();

        $data['categories'] = [];
        foreach($categories as $category)
        {
            $data['categories'][$category->id()] = $category->data()['name'];
        }

        $courses = app('firebase.firestore')->database()->collection('courses')->documents();

        $data['courses'] = [];

        foreach ($courses as $course) {
            $data['courses'][$course->id()] = $course->data()['title'];
        }

        $data['locations'] = [
            'Physical'  => 'Physical',
            'Online'    => 'Online'
        ];

        $data['location_types'] = [
            'Zoom'              => 'Zoom',
            'Webex'             => 'Webex',
            'Google Meet'       => 'Google Meet',
            'Microsoft Teams'   => 'Microsoft Teams',
        ];

        if ($data['id'] = $id) {
            $event = app('firebase.firestore')->database()
                ->collection('events')->document($data['id'])
                ->snapshot();

            $data['title']              = @$event->data()['title'];
            $data['category_id']        = @$event->data()['category_id'];
            $data['recommended_course'] = @$event->data()['recommended_course'];

            $eventMonth = date_parse($event->data()['event_month']);
 
            $data['start_date']         = $event->data()['event_date']
            .'-'.$eventMonth['month']
            .'-'.$event->data()['event_year']
            .' '.$event->data()['event_start_time'];

            $data['event_details']      = @$event->data()['event_details'];
            $data['address']            = @$event->data()['address'];
            $data['venue']              = @$event->data()['venue'];
            $data['image']              = @$event->data()['image'];

            $data['benefits_one'] = @$event->data()['benefits_one'];
            $data['benefits_two'] = @$event->data()['benefits_two'];
            $data['speaker'] = @$event->data()['speaker'];

            $data['weblink'] = [
                'name'          => $event->data()['weblink']['name'],
                'link'          => $event->data()['weblink']['link'],
            ];

            $data['location']           = @$event->data()['location'];
            $data['location_address']   = @$event->data()['location_address'];
            $data['location_type']      = @$event->data()['location_type'];
            $data['location']           = @$event->data()['image'];
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

        $data = $request->except(['_token']);

        if (!$request->benefits_one['title']) {
            unset($data['benefits_one']);
        }
        if (!$request->benefits_two['title']) {
            unset($data['benefits_two']);
        }

        if (@$data['start_date']) {
            $carbonDate = Carbon::parse($data['start_date']);
            $data['event_date'] = $carbonDate->format('d');
            $data['event_month'] = $carbonDate->format('F');
            $data['event_year'] = $carbonDate->format('y');
            $data['event_start_time'] = $carbonDate->format('H:s A');
            $data['event_end_time'] = $carbonDate->format('H:s A');
        }

        if ($image = $request->file('image')) {
            $image = StorageHelper::uploadFileAs($image, 'repository/events');
            $data['image'] =  $image;
        }

        $data['backend_user_id']    = Auth::user()->id;
        foreach($data as $key => $value) {
            if ($value == null) {
                unset($data[$key]);
            }
        }
        $data['users_enrolled']     = $data['users_attending'] = [];
        $data['max_attending']  = 2000;
        $documentId = User::generateRandomString();
        $event = app('firebase.firestore')->database()->collection('events')->document($documentId);
        $event->set($data);
        
        return response()->json([
            'success' => true,
            'title' => 'Event',
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

        $data = $request->except(['_token']);

        if (!$request->benefits_one['title']) {
            unset($data['benefits_one']);
        }
        if (!$request->benefits_two['title']) {
            unset($data['benefits_two']);
        }
        if (@$data['start_date']) {
            $carbonDate = Carbon::parse($data['start_date']);
            $data['event_date'] = $carbonDate->format('d');
            $data['event_month'] = $carbonDate->format('F');
            $data['event_year'] = $carbonDate->format('y');
            $data['event_start_time'] = $carbonDate->format('H:s A');
            $data['event_end_time'] = $carbonDate->format('H:s A');
        }
        if ($image = $request->file('image')) {
            $image = StorageHelper::uploadFileAs($image, 'repository/events');
            $data['image'] =  $image;
        }
        foreach($data as $key => $value) {
            if ($value == null) {
                unset($data[$key]);
            }
        }
        $update = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $update[] = [
                    'path'  => $key,
                    'value' => $value,
                ];
            }
        }

        $event = app('firebase.firestore')->database()->collection('events')->document($id);
        $event->update($update);

        return response()->json([
            'success' => true,
            'title' => 'Event',
            'message' => 'Updated Successfully!!!',
            'redirect' => route("sa.{$this->viewfolder}.index"),
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $event = Event::find($request->id);
        $event->status = $request->active;
        $event->save();

        return $event;
    }

    /**
     * 
     */
    public function destroy($id)
    {
        app('firebase.firestore')->database()->collection('events')->document($id)->delete();
    }

    public function EventParticipants(UserDataTable $dataTable)
    {
        $data['users'] = app('firebase.firestore')->database()->collection('users')->documents();
        
        return $dataTable->render("{$this->modulename}::{$this->viewfolder}.partials.participants", $data);
    }
}
