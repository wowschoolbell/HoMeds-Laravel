<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CustomerDataTable;
use App\Helpers\StorageHelper;
use App\Models\AppStatus;
use App\Models\customers;
use App\Models\Packages;
use App\Models\PasswordLink;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Mail;
use App\Models\store;
use App\Rules\BankAccountNumberValidator;
use App\Rules\UniquePhone;
use App\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    protected function _validation_rules($request, $id = NULL)
    {
        $rules['store.name'] = "required|string|max:225";
        $rules['store.mobile_number']       = ["required", new UniquePhone($id)];
        $rules['store.email']               = "email|max:255|unique:customers,email,{$id},id";
        $rules['store.flat_no']       =   "required";
        $rules['store.area']       =   "required";
        $rules['store.landmark']       =   "required";
        $rules['store.status']       =   "required";
        return $rules;
    }

    protected function _validation_messages()
    {
        return [
            'store.name.required'                   => "The Customer Name is required.",
            'store.mobile_number.required'          => "The Customer mobile number is required.",
            'store.email.email'                      => "The email must be a valid email address.",
            'store.email.unique'                     => "The email already exists.",
            'store.flat_no.required'              => "The flat field is required.",
            'store.area.required'              => "The Area field is required.",
            'store.landmark.required'              => "The landmark field is required.",
            'store.status.required'              => "The Status field is required.",
        ];
    }

    public function index(CustomerDataTable $dataTable)
    {   
        // $data['statuses'][0] = 'All';
        $data['title'] = 'Customer List';
        return $dataTable->render('admin.customers.index', $data);
    }
    public function create() 
    {



        $data['model'] = [
            'store' => new customers(),
        ];
        $data['title']      = 'Add Customer';
        // $data['statuses']       = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id');
        // $data['app_statuses']   = AppStatus::where('type', AppStatus::APP_STATUS)->pluck('name', 'id');

        return view('admin.customers.create', $data);
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            $this->_validation_rules($request),
            $this->_validation_messages()
        );
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }

        $userModel  = new Packages();
        $store      = $this->_save_store($request);
        // $this->sendmail($request->store['email']);

        return response()->json([
            'success' => true,
            'title' => 'Store',
            'message' => 'Successfully created ',
            'redirect' => route("admin.customers.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $store = customers::find($id);
        
        $data['model'] = [
            'store' => $store,
        ];

        $data['id']         = $id;
        $data['title']      = 'Edit Customer';
       
        return view('admin.customers.edit', $data);
    }
     public function update(Request $request, $id)
    {
        $store       = store::find($id);
        //$userModel      = $store->user;

        $validation = Validator::make($request->all(),$this->_validation_rules($request,$id),$this->_validation_messages());
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }

        
        // $user           = $this->_save_user($request, $store->user);
        $delivery       = $this->_save_store($request);

        return response()->json([
            'success' => true,
            'title' => 'Status',
            'message' => 'Updated created ',
            'redirect' => route("admin.customers.index"),
        ], 200);
    }
    protected function _save($request, $model)
    {
        $model->fill($request->get('store'));
        $model->save();
    }
    
     public function sendmail($email,$status,$appstataus,$reason,$name)
    {
        $domain = "https://".request()->getHost();
        $employee_master = $email;
        $username =$name;
        $current_timestamp = now()->timestamp;
        $PasswordLink = new PasswordLink();
        $benefits="";
        $plan_name = $appstataus;
        if($appstataus=="HoMeds"){
            $benefits="HoMEds | 1 Registration | 5 Users | Unlimited Products ,Orders and Delivery | Free Delivery Partner | HoMEds App Name | Free Setup Cost";
        } else if($appstataus=="White Label") {
            $benefits="White Label | 1 Registration | 5 Users | Unlimited Products ,Orders and Delivery | Free Delivery Partner | HoMEds App Name | Free Setup Cost";
        }
        $futureDate=date('Y-m-d', strtotime('+1 year'));

        $PasswordLink->email=$employee_master;
        $PasswordLink->hash=$current_timestamp;
        $PasswordLink->save();

        if(isset($reason)){
          Mail::send('admin.store.sendmailreason', ["name"=>$username,'status'=>$status,'reason'=>$reason,'domain'=>$domain], function($message) use($employee_master,$status){
            $message->to($employee_master);
            $message->subject('HoMEds Account '.$status);
          });
        } else {
             Mail::send('admin.store.sendmail', ["name"=>$username,'link' => $domain."/public/passwordreset/".$current_timestamp,"benefits"=>$benefits,'plan_name'=>$plan_name,'expire_date'=>$futureDate,'email'=>$email,'reason'=>$reason,'domain'=>$domain], function($message) use($employee_master,$status){
              $message->to($employee_master);
              $message->subject('HoMEds Account '.$status);
          });
        }
    }

    protected function _save_user($request, $model)
    {
        $userdata = $request->get('user');
        $model->fill($userdata);
        $model->save();

        $model->username = $model->id;
        $model->save();
        return $model;
    }

    protected function _save_store($request) {

        if ($request->id){
           $store = customers::find($request->id);
        } 
        else{
            $store = new customers();
        }

         $store->name =$request->store["name"];
         $store->mobile_number =$request->store["mobile_number"];
         $store->email =$request->store["email"];
         $store->flat_no =$request->store["flat_no"];
         $store->area =$request->store["area"];
         $store->landmark =$request->store["landmark"];
        $store->adddress =$request->store["adddress"];
        $store->state =$request->store["state"];
        $store->city =$request->store["city"];
         $store->status =$request->store["status"];
 
        $store->save();

        return $store;
    }

    
}
