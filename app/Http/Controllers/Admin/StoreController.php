<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoreDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\store;
use App\Models\AppStatus;
use Illuminate\Foundation\Validation\ValidatesRequests;

class StoreController extends Controller
{
    public function index(StoreDataTable $dataTable)
    {
        $data['statuses']["all"] = 'All';
        $data['statuses']['active']= "Active";
        $data['statuses']['in-active']= "In-Active";
        $data['statuses']['waiting_for_the_appproval']= "Waiting for the appproval";
        $data['statuses']['hold']= "Hold";
        return $dataTable->render('admin.store.index',$data);
    }
    public function create() 
    {
    
       
        
        $data['model'] = [
            'store' => new store()
        ];

        $data['title']      = 'Add Store';
        $data['route']      = 'admin.store.store';
        $data['method']     = 'post';
        
        $data['statuses']["all"] = 'All';
        $data['statuses']['active']= "Active";
        $data['statuses']['in-active']= "In-Active";
        $data['statuses']['waiting_for_the_appproval']= "Waiting for the appproval";
        $data['statuses']['hold']= "Hold";
        
        
        

        return view('admin.store.create', $data);
    }
    public function store(Request $request)
    {
        
        $data =  $request->store;
        
        
    if($request->id){
        
         $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'contact_person_name'=>"required|string|max:255",
            'email' => 'required|unique:stores,email,'.$id.',id',
            'phone' => 'required|string|max:255',
             'mobile_number' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longtitude' => 'required|string|max:255',
        ]);
        
    } else {
       $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'contact_person_name'=>"required|string|max:255",
            'email' => 'required|string|email|max:255|unique:stores',
            'phone' => 'required|string|max:255',
             'mobile_number' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longtitude' => 'required|string|max:255',
        ]);
    }
    
    if ($validator->fails()) {
           
            $response['message'] = json_encode($validator->messages());
            $response['status'] = 400;
            $response['statusText'] = 'Failed';
            return response()->json($response, 500);
        
           // return withErrors($validator)
             //       ->withInput();
      } else {
          
       // dd($data['store_image']);
             
        if($request->id){
            $store = store::findOrFail($request->id);
        } else {
            $store = new store();
        }
          $store->name = $request->store['name'];
          $store->contact_person_name = $request->store['contact_person_name'];
          $store->phone = $request->store['phone'];
          $store->email = $request->store['email'];
          $store->latitude = $request->store['latitude'];
          $store->longtitude = $request->store['longtitude'];
          $store->mobile_number = $request->store['mobile_number'];
          $store->gst_number = $request->store['gst_number'];
          $store->drug_licence = $request->store['drug_licence'];
          if(isset($request->store['password'])){
            $store->password = bcrypt($request->store['password']);
          }
          $store->address = $request->store['address'];
          if(isset($request->store['location'])){
             $store->location = $request->store['location'];
          }
          $store->area = $request->store['area'];
          $store->state = $request->store['state'];
          $store->city = $request->store['city'];
          $store->pincode = $request->store['pincode'];
          $store->city = $request->store['city'];
          $store->bank_name = $request->store['bank_name'];
          $store->bank_account_number = $request->store['bank_account_number'];
          $store->ifsc_code = $request->store['ifsc_code'];
          $store->app_status = $request->store['app_status'];
          $store->status = $request->store['status'];
          if(isset($request->store['store_image'])) {
            $store->store_image = asset('storage/'.$request->store['store_image']->store('shops'));
          }
          if(isset($request->store['store_logo'])) {
            $store->store_logo = asset('storage/'.$request->store['store_logo']->store('shops'));
          }
          $store ->save();
          
        
      }

        return response()->json([
            'success' => true,
            'title' => 'Store Status',
            'message' => 'Successfully created ',
            'redirect' => route("admin.store.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $data['model'] = [
            'category' => store::findOrFail($id)
        ];
        
        $store = store::findOrFail($id);
        
    
        $data['title']      = 'Edit store';
        $data['route']      = 'admin.store.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;
       

        return view('admin.store.create', $data);
    }
      public function view($id)
    {
        $data['model'] = [
            'category' => store::findOrFail($id)
        ];
        
        $store = store::findOrFail($id);
        
    
        $data['title']      = 'Edit store';
        $data['route']      = 'admin.store.update';
        $data['method']     = 'put';
        $data['routeIds']   =  $id;
       

        return view('admin.store.view', $data);
    }
     public function update(Request $request, $id)
    {
        $model = store::findOrFail($id);
        $this->_save($request, $model);

        return response()->json([
            'success' => true,
            'title' => 'Store',
            'message' => 'Successfully updated',
            'redirect' => route("admin.store.index"),
        ], 200);
    }
    protected function _save($request, $model)
    {
        $model->fill($request->get('store'));
        $model->save();
    }
}
