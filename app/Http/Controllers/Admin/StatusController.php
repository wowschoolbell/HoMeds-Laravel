<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StatusDataTable;
use App\Helpers\StorageHelper;
use App\Models\AppStatus;
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

class StatusController extends Controller
{
    protected function _validation_rules($request, $id = NULL)
    {
        $rules['store.plan_id']                = "required|string|max:225";
        $rules['store.name'] = "required|string|max:225";
        $rules['store.description']               ="required|string|max:225";
        $rules['store.plan_type']       =   "required";
        return $rules;
    }

    protected function _validation_messages()
    {
        return [
            'store.plan_id.required'          => "The Plan is required.",
            'store.name.required'                   => "The Name is required.",
            'store.description.required'    => "The Description is required.",
            'store.plan_type.required'                  => "The Plan ype is required.",
        ];
    }

    public function index(StatusDataTable $dataTable)
    {   
        // $data['statuses'][0] = 'All';
        $data['title'] = 'App Status';
        return $dataTable->render('admin.status.index', $data);
    }
    public function create() 
    {



        $data['model'] = [
            'store' => new Store(),
            'user'  => new User()
        ];
        $data['title']      = 'Add Store';
        $data['statuses']       = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id');
        $data['app_statuses']   = AppStatus::where('type', AppStatus::APP_STATUS)->pluck('name', 'id');

        return view('admin.status.create', $data);
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
            'redirect' => route("admin.status.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $store = Packages::find($id);
        
        $data['model'] = [
            'user' => $store->user,
            'store' => $store,
        ];

        $data['id']         = $id;
        $data['title']      = 'Edit Status';
        $data['statuses']       = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id');
        $data['app_statuses']   = AppStatus::where('type', AppStatus::APP_STATUS)->pluck('name', 'id');

        return view('admin.status.edit', $data);
    }
     public function update(Request $request, $id)
    {
        $store       = store::find($id);
        //$userModel      = $store->user;

        $validation = Validator::make($request->all(),$this->_validation_rules($request),$this->_validation_messages());
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
            'redirect' => route("admin.status.index"),
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
           $store = Packages::find($request->id);
        } 
        else{
            $store = new Packages();
        }

         $store->plan_id =$request->store["plan_id"];
         $store->name =$request->store["name"];
         $store->description =$request->store["description"];
         $store->plan_type =$request->store["plan_type"];
            //}
           // $this->sendmail($request->store['email'],);
        
        //$store->fill($request->get('store'));
        $store->save();

        return $store;
    }

    
}
