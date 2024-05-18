<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoreDataTable;
use App\Helpers\StorageHelper;
use App\Models\AppStatus;
use App\Models\PasswordLink;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Mail;
use App\Models\store;
use App\Rules\BankAccountNumberValidator;
use App\Rules\UniquePhone;
use App\User;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    protected function _validation_rules($request, $id = NULL)
    {
        $rules['store.name']                = "required|string|max:225";
        $rules['store.contact_person_name'] = "required|string|max:225";
        $rules['user.phone']               = ["required", new UniquePhone($id)];
        $rules['store.mobile_number']       = ["required", new UniquePhone($id)];
        $rules['user.email']                = "email|max:255|unique:users,email,{$id},id";
        $rules['store.status_id']           = "required";
        $rules['store.app_status_id']       = "required";

        if (!$id) {
            $rules['store.store_logo']          = "required";
        }

        $rules['store.gst_number']          = "required|max:255|unique:stores,gst_number,{$id},user_id";
        $rules['store.drug_licence']        = "required|max:255|unique:stores,drug_licence,{$id},user_id";

        $rules['store.bank_account_number'] = ["required", new BankAccountNumberValidator($id)];

        return $rules;
    }

    protected function _validation_messages()
    {
        return [
            'store.name.required'                   => "The store Name is required.",
            'store.contact_person_name.required'    => "The contact person name is required.",
            'store.phone.required'                  => "The phone number is required.",
            'store.mobile_number.required'          => "The mobile number is required.",
            'user.email.email'                      => "The email must be a valid email address.",
            'user.email.unique'                     => "The email already exists.",
            'store.status_id.required'              => "The status field is required.",
            'store.app_status_id.required'          => "The app status field is required.",
            'store.store_logo.required'             => "The Logo field is required.",
            'store.gst_number.required'             => "The GST number is required.",
            'store.drug_licence.required'           => "The drug licence is required.",
            'store.bank_account_number.required'    => "The bank account number required is required.",
        ];
    }

    public function index(StoreDataTable $dataTable)
    {   
        $data['statuses'][0] = 'All';
        $statuses   = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id')->toArray();

        foreach($statuses as $key => $status) {
            $data['statuses'][$key] = $status;
        }

        $data['title'] = 'Store';
        return $dataTable->render('admin.store.index', $data);
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

        return view('admin.store.create', $data);
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

        $userModel  = new User();
        $user       = $this->_save_user($request, $userModel);
        $store      = $this->_save_store($request, $user);
        // $this->sendmail($request->store['email']);

        return response()->json([
            'success' => true,
            'title' => 'Store',
            'message' => 'Successfully created ',
            'redirect' => route("admin.store.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $store = store::find($id);
        
        $data['model'] = [
            'user' => $store->user,
            'store' => $store,
        ];

        $data['id']         = $id;
        $data['title']      = 'Edit Store Partner';
        $data['statuses']       = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id');
        $data['app_statuses']   = AppStatus::where('type', AppStatus::APP_STATUS)->pluck('name', 'id');

        return view('admin.store.edit', $data);
    }
     public function update(Request $request, $id)
    {
        $store       = store::find($id);
        $userModel      = $store->user;

        $validation = Validator::make($request->all(),$this->_validation_rules($request, $userModel->id),$this->_validation_messages());
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }

        
        $user           = $this->_save_user($request, $store->user);
        $delivery       = $this->_save_store($request, $user);

        return response()->json([
            'success' => true,
            'title' => 'Store',
            'message' => 'Updated created ',
            'redirect' => route("admin.store.index"),
        ], 200);
    }
    protected function _save($request, $model)
    {
        $model->fill($request->get('store'));
        $model->save();
    }
    
     public function sendmail($email)
    {
        $employee_master = $email;
        $current_timestamp = now()->timestamp;
        $PasswordLink = new PasswordLink();
        $PasswordLink->email=$employee_master;
        $PasswordLink->hash=$current_timestamp;
        $PasswordLink->save();
        Mail::send('admin.store.sendmail', ['link' => "https://homeds.wowschoolbell.in/public/passwordreset/".$current_timestamp], function($message) use($employee_master){
              $message->to($employee_master);
              $message->subject('Reset Password');
         });
    }

    protected function _save_user($request, $model)
    {
        $userdata = $request->get('user');
        $userdata['password'] = bcrypt("!Nt3l#risXe@43");
        $model->fill($userdata);
        $model->name = $request->store['contact_person_name'];
        $model->save();

        $model->username = $model->id;
        $model->save();
        return $model;
    }

    protected function _save_store($request, $user) {

        if ($user->store)
            $store = $user->store;
        else
            $store = new Store();

        $store->user_id = $user->id;
        $store->fill($request->get('store'));
        $store->save();

        $storeLogo = $request->file('store.store_image');

        if($storeLogo) {
            $filePath = StorageHelper::uploadFile($storeLogo, "st");
            $store = Store::find($store->id);
            $store->update(['store_logo'=>$filePath]);
        }

        $storeImage = $request->file('store.store_image');

        if($storeImage) {
            $filePath = StorageHelper::uploadFile($storeImage, "st");
            $store = Store::find($store->id);
            $store->update(['store_image'=>$filePath]);
        }


        return $store;
    }

    
}
