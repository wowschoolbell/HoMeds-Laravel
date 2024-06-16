<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DiseaseDataTable;
use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\cure_disease;
use App\Models\State;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DiseaseController extends Controller
{
    public function index(DiseaseDataTable $dataTable)
    {
        
        $data['title'] = 'Disease';
        
        return $dataTable->render('admin.disease.index', $data);
    }

    public function create() 
    {
        $data['model'] = [
            'disease' => new cure_disease()
        ];

        // $data['states']     = State::pluck('name', 'id');
        $data['title']      = 'Add disease';
        $data['route']      = 'admin.disease.store';
        $data['method']     = 'post';

        return view('admin.disease.partials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new cure_disease();
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'Disease',
            'message' => 'Successfully created ',
            'redirect' => route("admin.disease.index"),
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
            'disease' => cure_disease::findOrFail($id)
        ];

       // $data['states']     = State::pluck('name', 'id');
        $data['title']      = 'Edit disease';
        $data['route']      = 'admin.disease.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;

        return view('admin.disease.partials.form', $data);
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
        $model = cure_disease::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'disease',
            'message' => 'Successfully updated',
            'redirect' => route("admin.disease.index"),
        ], 200);
    }


    protected function _save($request, $model)
    {
        $model->fill($request->get('cities'));
        $model->save();
    }

        /**
     * 
     */
    public function import(Request $request) 
    {
        
        if ($file = @$request->file('file')) {

            $filePath = StorageHelper::uploadFile($file, "dp");
            $file = storage_path('app/public/'.$filePath);

            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            // Get the active sheet
            $sheet = $spreadsheet->getActiveSheet();

            $data = $sheet->toArray(null, true, true, false);

            foreach ($data as $key => $values) {
                if ($key != 0) {
                    $count = cure_disease::where('name', $value)->count();

                    if ($count == 0) {

                            $state = new cure_disease();
                            $state->name = $value;
                            $state->save();
                    }
                }
            }

            unlink($file);
            
            Alert::success('Disease', 'File uploaded successfully');
            return redirect()->route('admin.disease.index');
        }

        $data['title'] = 'Import Disease';

        return view('admin.disease.partials.import', $data);
    }

}
