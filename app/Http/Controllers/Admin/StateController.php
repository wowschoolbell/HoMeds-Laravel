<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StateDataTable;
use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StateController extends Controller
{

    public function index(StateDataTable $dataTable)
    {
        
        $data['title'] = 'States';
        
        return $dataTable->render('admin.states.index', $data);
    }

    public function create() 
    {
        $data['model'] = [
            'states' => new State()
        ];

        $data['title']      = 'Add State';
        $data['route']      = 'admin.states.store';
        $data['method']     = 'post';

        return view('admin.states.partials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $model = new State();
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'State',
            'message' => 'Successfully created ',
            'redirect' => route("admin.states.index"),
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
            'states' => State::findOrFail($id)
        ];

        $data['title']      = 'Edit State';
        $data['route']      = 'admin.states.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;

        return view('admin.states.partials.form', $data);
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
        $model = State::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'State',
            'message' => 'Successfully updated',
            'redirect' => route("admin.states.index"),
        ], 200);
    }


    protected function _save($request, $model)
    {
        $model->fill($request->get('states'));
        $model->save();
    }

    /**
     * 
     */
    public function import() {

    }
}
