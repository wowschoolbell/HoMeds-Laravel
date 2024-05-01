<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDataTable;
use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CityController extends Controller
{
    public function index(CityDataTable $dataTable)
    {
        
        $data['title'] = 'Cities';
        
        return $dataTable->render('admin.cities.index', $data);
    }

    public function create() 
    {
        $data['model'] = [
            'cities' => new City()
        ];

        $data['states']     = State::pluck('name', 'id');
        $data['title']      = 'Add City';
        $data['route']      = 'admin.cities.store';
        $data['method']     = 'post';

        return view('admin.cities.partials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new City();
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'City',
            'message' => 'Successfully created ',
            'redirect' => route("admin.cities.index"),
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
            'cities' => City::findOrFail($id)
        ];

        $data['states']     = State::pluck('name', 'id');
        $data['title']      = 'Edit City';
        $data['route']      = 'admin.cities.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;

        return view('admin.cities.partials.form', $data);
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
        $model = City::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'City',
            'message' => 'Successfully updated',
            'redirect' => route("admin.cities.index"),
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
                    $stateId = State::where('name', $values[0])->get()->first()->id;

                    if ($stateId) {
                        $cities = City::where('state_id', $stateId)
                            ->where('city', $values[1])
                            ->where('area', $values[2])
                            ->where('pincode', $values[3])
                            ->count();

                        if ($cities == 0) {

                            $city           = new City();
                            $city->state_id = $stateId;
                            $city->city     = $values[1];
                            $city->area     = $values[2];
                            $city->pincode  = $values[3];
                            $city->save();
                        }
                    }
                }
            }

            unlink($file);
            
            Alert::success('Cities', 'File uploaded successfully');
            return redirect()->route('admin.cities.index');
        }

        $data['title'] = 'Import Cities';

        return view('admin.cities.partials.import', $data);
    }

}
