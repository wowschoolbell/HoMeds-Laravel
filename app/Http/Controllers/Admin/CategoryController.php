<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\State;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        
        $data['title'] = 'Category';
        
        return $dataTable->render('admin.category.index', $data);
    }

    public function create() 
    {
        $data['model'] = [
            'category' => new category()
        ];

        // $data['states']     = State::pluck('name', 'id');
        $data['title']      = 'Add category';
        $data['route']      = 'admin.category.store';
        $data['method']     = 'post';

        return view('admin.category.partials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new category();
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'Category',
            'message' => 'Successfully created ',
            'redirect' => route("admin.category.index"),
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
            'category' => category::findOrFail($id)
        ];

       // $data['states']     = State::pluck('name', 'id');
        $data['title']      = 'Edit Category';
        $data['route']      = 'admin.category.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;

        return view('admin.category.partials.form', $data);
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
        $model = category::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'Category',
            'message' => 'Successfully updated',
            'redirect' => route("admin.category.index"),
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
                    $count = category::where('name', $value)->count();

                    if ($count == 0) {

                            $state = new Category();
                            $state->name = $value;
                            $state->save();
                    }
                }
            }

            unlink($file);
            
            Alert::success('Category', 'File uploaded successfully');
            return redirect()->route('admin.category.index');
        }

        $data['title'] = 'Import Category';

        return view('admin.category.partials.import', $data);
    }

}
