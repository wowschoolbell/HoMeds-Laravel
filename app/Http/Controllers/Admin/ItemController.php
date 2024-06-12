<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ItemDataTable;
use App\Helpers\StorageHelper;
use App\Models\AppStatus;
use App\Models\customers;
use App\Models\Packages;
use App\Models\PasswordLink;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Mail;
use App\Models\store;
use App\Models\items;
use App\Rules\BankAccountNumberValidator;
use App\Rules\UniquePhone;
use App\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    protected function _validation_rules($request, $id = NULL)
    {
        $rules['store.item_code'] = "required|string|max:225";
        $rules['store.store_item_code']       = "required|string|max:225";
        $rules['store.category']       = "required|string|max:225";
        $rules['store.name']       = "required|string|max:225";
        $rules['store.chemincal_name']       = "required|string|max:225";
        $rules['store.cure_disease']               = "required|string|max:225";
        $rules['store.status']       =   "required";
        return $rules;
    }

    protected function _validation_messages()
    {
        return [
            'store.item_code.required'                   => "The Item Code is required.",
            'store.store_item_code.required'          => "The Store Item Code is required.",
            'store.category.required'                      => "The Category is required",
            'store.name.required'                     => "The Name is required",
            'store.chemincal_name.required'              => "The Chemincal Name field is required.",
            'store.cure_disease.required'              => "The Cure Disease field is required.",
            'store.status.required'              => "The Status field is required.",
        ];
    }

    public function index(ItemDataTable $dataTable)
    {   
        // $data['statuses'][0] = 'All';
        $data['title'] = 'Items List';
        return $dataTable->render('admin.items.index', $data);
    }
    public function create() 
    {



        $data['model'] = [
            'store' => new items(),
        ];
        $data['title']      = 'Add Items';
        // $data['statuses']       = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id');
        // $data['app_statuses']   = AppStatus::where('type', AppStatus::APP_STATUS)->pluck('name', 'id');

        return view('admin.items.create', $data);
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
        $store      = $this->_save_store($request);
        // $this->sendmail($request->store['email']);

        return response()->json([
            'success' => true,
            'title' => 'items',
            'message' => 'Successfully created ',
            'redirect' => route("admin.items.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $store = items::find($id);
        
        $data['model'] = [
            'store' => $store,
        ];

        $data['id']         = $id;
        $data['title']      = 'Edit item';
       
        return view('admin.items.edit', $data);
    }
     public function update(Request $request, $id)
    {
        $store       = items::find($id);
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
            'redirect' => route("admin.items.index"),
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
           $store = items::find($request->id);
        } 
        else{
            $store = new items();
        }

         $store->item_code =$request->store["item_code"];
         $store->store_item_code =$request->store["store_item_code"];
         $store->category =$request->store["category"];
         $store->name =$request->store["name"];
         $store->chemincal_name =$request->store["chemincal_name"];
         $store->cure_disease =$request->store["cure_disease"];
         $store->status =$request->store["status"];
 
        $store->save();

        return $store;
    }

    
}
