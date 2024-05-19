<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryPartnerDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoreDataTable;
use App\Helpers\StorageHelper;
use App\Models\AppStatus;
use App\Models\City;
use App\Models\DeliveryPartner;
use App\Models\store;
use App\Rules\AadhaarValidator;
use App\Rules\BankAccountNumberValidator;
use App\Rules\TNDrivingLicenseValidator;
use App\User;
use Illuminate\Support\Facades\Validator;

class DeliveryPartnerController extends Controller
{
    protected function _validation_rules($request, $id = NULL)
    {

        $deliveryPartnerId = NULL;

        if ($id) {
            $deliveryPartnerId = User::find($id)->delivery_partner->id;
        } else {
            $rules['delivery_partner.photo'] = "required";
            // $rules['delivery_partner.aadhar_image'] = "required";
            // $rules['delivery_partner.driving_licence_image'] = "required";
        }
        
        $rules['delivery_partner.first_name'] = "required|string|max:225";
        $rules['delivery_partner.last_name'] = "required|string|max:225";
        $rules['delivery_partner.gender'] = "required|string|max:225";
        $rules['user.email'] = "email|max:255|unique:users,email,{$id},id";
        $rules['delivery_partner.phone'] = "required|integer|min:10|unique:users,phone,{$id},id";
        $rules['delivery_partner.app_statuses_id'] = "required|string|max:225";

        $rules['delivery_partner.aadhar'] = ['required', new AadhaarValidator(), "unique:delivery_partners,aadhar,{$deliveryPartnerId},id"];
        $rules['delivery_partner.driving_licence'] = ['required', 'string', "unique:delivery_partners,driving_licence,{$deliveryPartnerId},id"];
        $rules['delivery_partner.pan'] = ['required', 'string', "unique:delivery_partners,pan,{$deliveryPartnerId},id"];
        
        // $rules['delivery_partner.bank_name'] = "required|string|max:225";
        $rules['delivery_partner.bank_acc_number'] = "required|string|min:9|unique:delivery_partners,bank_acc_number,{$deliveryPartnerId},id";
        // $rules['delivery_partner.ifsc'] = "required|string|max:225";

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
            'delivery_partner.gender.required' => 'The Gender is required.',
            'delivery_partner.photo.required' => 'Photo is required.',
            
            'delivery_partner.phone.required' => 'The Phone number is required.',
            'delivery_partner.phone.integer' => 'The Phone number must be integer.',
            'delivery_partner.phone.max' => 'The Phone number may not be greater than 10.',
            'delivery_partner.phone.min' => 'The Phone number must be at least 10.',
            'delivery_partner.phone.unique' => 'The Phone number has already been taken.',
            
            'delivery_partner.app_statuses_id.required' => 'The App Status is required.',

            'delivery_partner.aadhar.required' => 'The Aadhar number is required.',
            'delivery_partner.aadhar.unique' => 'The Aadhar number has already been taken.',

            'delivery_partner.pan.required' => 'The PAN number is required.',
            'delivery_partner.pan.unique' => 'The PAN number has already been taken.',

            'delivery_partner.driving_licence.required' => 'The Driving Licence number is required.',
            'delivery_partner.driving_licence.unique' => 'The Driving Licence number has already been taken.',
            'delivery_partner.aadhar_image.required' => 'The Aadhar document is required.',
            'delivery_partner.driving_licence_image.required' => 'The Driving Licence document is required.',

            'delivery_partner.bank_name.required' => 'The Bank name is required.',
            'delivery_partner.ifsc.required' => 'The IFSC is required.',
            'delivery_partner.bank_account_number.required' => 'The Bank account number is required.',
            'delivery_partner.bank_account_number.min' => 'The Bank account number must be at least 10.',
            'delivery_partner.bank_account_number.unique' => 'The Bank account number has already been taken.',

        ];
    }

    public function index(DeliveryPartnerDataTable $dataTable)
    {   $data['statuses'][0] = 'All';
        $statuses   = AppStatus::where('type', AppStatus::STATUS)->pluck('name', 'id')->toArray();

        foreach($statuses as $key => $status) {
            $data['statuses'][$key] = $status;
        }
        

        $data['title'] = 'Pilot';
        return $dataTable->render('admin.delivery_partner.index', $data);
    }
    public function create() 
    {
        $data['model'] = [
            'delivery_partner' => new DeliveryPartner(),
        ];

        $data['title']      = 'Add Pilot';
        $data['statuses']   = AppStatus::pluck('name', 'id');
        $data['gender']     = User::$gender;

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
            'title' => 'Pilot',
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
        $data['title']      = 'Edit Pilot';
        $data['statuses']   = AppStatus::pluck('name', 'id');
        $data['gender']     = User::$gender;

        if ($deliveryPartner->city_id) {
            $data['city']       = City::find($deliveryPartner->city_id);
        }

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
            'title' => 'Pilot',
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
        $userdata['password'] = bcrypt("!Nt3l#risXe@43");
        $model->fill($userdata);
        $model->name = $request->delivery_partner['first_name'];
        $model->phone = $request->delivery_partner['phone'];
        $model->save();

        $model->username = $model->id;
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

        $aadharImage = $request->file('delivery_partner.aadhar_front_image');

        if($aadharImage) {
            $filePath = StorageHelper::uploadFile($aadharImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['aadhar_front_image'=>$filePath]);
        }

        $aadharImage = $request->file('delivery_partner.aadhar_back_image');

        if($aadharImage) {
            $filePath = StorageHelper::uploadFile($aadharImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['aadhar_back_image'=>$filePath]);
        }

        $drivingLicenceImage = $request->file('delivery_partner.driving_licence_front_image');

        if($drivingLicenceImage) {
            $filePath = StorageHelper::uploadFile($drivingLicenceImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['driving_licence_front_image'=>$filePath]);
        }

        $drivingLicenceImage = $request->file('delivery_partner.driving_licence_back_image');

        if($drivingLicenceImage) {
            $filePath = StorageHelper::uploadFile($drivingLicenceImage, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['driving_licence_back_image'=>$filePath]);
        }

        $pan_image = $request->file('delivery_partner.pan_image');

        if($pan_image) {
            $filePath = StorageHelper::uploadFile($pan_image, "dp");
            //retriving from DB and change date format
            $deliveryPartner = DeliveryPartner::find($deliveryPartner->id);
            $deliveryPartner->update(['pan_image'=>$filePath]);
        }

        return $deliveryPartner;
    }

    
}
