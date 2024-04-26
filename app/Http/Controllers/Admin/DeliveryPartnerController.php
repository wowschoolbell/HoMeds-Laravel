<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryPartnerDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoreDataTable;
use App\Helpers\StorageHelper;
use App\Models\AppStatus;
use App\Models\DeliveryPartner;
use App\Models\store;
use App\User;
use Illuminate\Support\Facades\Validator;

class DeliveryPartnerController extends Controller
{
    protected function _validation_rules($request, $id = NULL)
    {
        if($request->user['email']){ // if email available
            $rules['user.email'] = "email|max:255|unique:users,email,{$id},id";
        }
        $rules['user.username'] = "required|string|max:255|unique:users,username,{$id},id";
        if (!$id) { // On Create Only
            $rules['user.password'] = "required|string|min:6";
        } else if($request->user['password']) {
            $rules['user.password'] = "string|min:6";
        }
        // Student Table Details
        $rules['delivery_partner.first_name'] = "required|string|max:225";
        $rules['delivery_partner.last_name'] = "required|string|max:225";
        $rules['delivery_partner.phone'] = "required|string|max:225";
        $rules['delivery_partner.app_statuses_id'] = "required|string|max:225";
        $rules['delivery_partner.aadhar'] = "required|string|max:225";
        $rules['delivery_partner.driving_licence'] = "required|string|max:225";
        $rules['delivery_partner.bank_name'] = "required|string|max:225";
        $rules['delivery_partner.ifsc'] = "required|string|max:225";
        $rules['delivery_partner.bank_account_number'] = "required|string|max:225";
        if ($id = null || $request->delivery_partner['re_enter_bank_account_number']) {
            $rules['delivery_partner.re_enter_bank_account_number'] = "required|string|max:225|same:delivery_partner.bank_account_number";
        }
        $rules['delivery_partner.area'] = "required|string|max:225";
        $rules['delivery_partner.city'] = "required|string|max:225";
        $rules['delivery_partner.state'] = "required|string|max:225";
        $rules['delivery_partner.pincode'] = "required|string|max:225";
        $rules['delivery_partner.area_mapping_state'] = "required|string|max:225";
        $rules['delivery_partner.area_mapping_area'] = "required|string|max:225";
        $rules['delivery_partner.area_mapping_city'] = "required|string|max:225";
        $rules['delivery_partner.area_mapping_pincode'] = "required|string|max:225";

        return $rules;
    }

    protected function _validation_messages()
    {
        return [
            'user.username.required' => "The User Name field is required.",
            'user.email.email' => "The Email must be a valid email address.",
            'user.email.unique' => "The Email has already been taken.",
            'user.password.required' => 'The Password field is required',
            'user.password.min' => 'The Password must be at least 6 characters.',

            'delivery_partner.first_name.required' => 'The First Name is required.',
            'delivery_partner.last_name.required' => 'The Last Name is required.',
            'delivery_partner.phone.required' => 'The Last Name is required.',
            'delivery_partner.app_statuses_id.required' => 'The App Status is required.',

            'delivery_partner.aadhar.required' => 'The Aadhar number is required.',
            'delivery_partner.driving_licence.required' => 'The Driving Licence number is required.',
            'delivery_partner.bank_name.required' => 'The Bank name is required.',
            'delivery_partner.ifsc.required' => 'The IFSC is required.',
            'delivery_partner.bank_account_number.required' => 'The Bank account number is required.',
            'delivery_partner.re_enter_bank_account_number.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.re_enter_bank_account_number.same' => 'The Re enter bank account number and Bank account number must match.',

            'delivery_partner.area.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.city.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.state.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.pincode.required' => 'The Re Enter Bank account number is required.',

            'delivery_partner.area_mapping_area.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.area_mapping_city.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.area_mapping_state.required' => 'The Re Enter Bank account number is required.',
            'delivery_partner.area_mapping_pincode.required' => 'The Re Enter Bank account number is required.',

        ];
    }

    public function index(DeliveryPartnerDataTable $dataTable)
    {   $data['statuses'][0] = 'All';
        $statuses   = AppStatus::pluck('name', 'id')->toArray();

        foreach($statuses as $key => $status) {
            $data['statuses'][$key] = $status;
        }
        

        $data['title'] = 'Delivery Partner';
        return $dataTable->render('admin.delivery_partner.index', $data);
    }
    public function create() 
    {
        $data['model'] = [
            'delivery_partner' => new DeliveryPartner(),
        ];

        $data['title']      = 'Add Delivery Partner';
        $data['statuses']   = AppStatus::pluck('name', 'id');
        

        return view('admin.delivery_partner.create', $data);
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

        $userModel      = new User();
        $user           = $this->_save_user($request, $userModel);
        $delivery       = $this->_save_delivery_partner($request, $user);

        return response()->json([
            'success' => true,
            'title' => 'Delivery Partner',
            'message' => 'Successfully created ',
            'redirect' => route("admin.delivery_partner.index"),
        ], 200);
    }
    
    public function edit($id)
    {
        $deliveryPartner = DeliveryPartner::find($id);
        
        $data['model'] = [
            'user' => $deliveryPartner->user,
            'delivery_partner' => $deliveryPartner,
        ];

        $data['id']         = $id;
        $data['title']      = 'Edit Delivery Partner';
        $data['statuses']   = AppStatus::pluck('name', 'id');

        return view('admin.delivery_partner.edit', $data);
    }
     public function update(Request $request, $id)
    {
        $delivery       = DeliveryPartner::find($id);
        $userModel      = $delivery->user;

        $validation = Validator::make($request->all(),$this->_validation_rules($request, $userModel->id),$this->_validation_messages());
        if ($validation->fails())
        {
            return response()->json([
                'success' => false,
                'message' => json_decode($validation->errors())
            ], 422);
        }

        
        $user           = $this->_save_user($request, $delivery->user);
        $delivery       = $this->_save_delivery_partner($request, $user);

        return response()->json([
            'success' => true,
            'title' => 'Delivery Partner',
            'message' => 'Updated created ',
            'redirect' => route("admin.delivery_partner.index"),
        ], 200);
    }
    protected function _save($request, $model)
    {
        $model->fill($request->get('store'));
        $model->save();
    }

    protected function _save_user($request, $model)
    {
        $userdata = $request->get('user');
        if (!empty($userdata['password'])) {
            $userdata['password'] = bcrypt($userdata['password']);
        } else {
            unset($userdata['password']);
        }
        $model->fill($userdata);
        $model->name = $request->delivery_partner['first_name'];
        $model->save();

        return $model;
    }

    protected function _save_delivery_partner($request, $user) {
        if ($user->delivery_partner)
            $deliveryPartner = $user->delivery_partner;
        else
            $deliveryPartner = new DeliveryPartner();

        $deliveryPartner->user_id = $user->id;
        $deliveryPartner->fill($request->get('delivery_partner'));
        $deliveryPartner->save();

        $deliveryPartnerImage = $request->file('delivery_partner.photo');

        if($deliveryPartnerImage) {
            $filePath = StorageHelper::uploadFile($deliveryPartnerImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['photo'=>$filePath]);
        }

        $aadharImage = $request->file('delivery_partner.aadhar_image');

        if($aadharImage) {
            $filePath = StorageHelper::uploadFile($aadharImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['aadhar_image'=>$filePath]);
        }

        $drivingLicenceImage = $request->file('delivery_partner.driving_licence_image');

        if($drivingLicenceImage) {
            $filePath = StorageHelper::uploadFile($drivingLicenceImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['driving_licence_image'=>$filePath]);
        }

        return $deliveryPartner;
    }

    
}
