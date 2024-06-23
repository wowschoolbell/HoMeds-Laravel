<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\store;
use App\Models\DeliveryPartner;
use App\Models\PasswordLink;
use App\Models\Permission;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use App\User;
use Modules\Superadmin\Entities\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('home', $data);
    }

    public function updateSeeder() {
        $roles = Role::$hidden_roles;

        foreach($roles as $value)
        {
            Role::firstOrCreate(
                ['name' => $value]
            );
        }
        
        $permissions = Permission::$list;

        foreach($permissions as $key => $value)
        {
            Permission::firstOrCreate(
                ['name' => $value],
                ['slug' => $key]
            );
        }

        $admin = Role::where('name', Role::ADMIN)->first();
        $adminPermissions = Permission::whereIn('name', Permission::$adminPermissionList)->get()->pluck('id');
        $admin->syncPermissions($adminPermissions);

        $store              = Role::where('name', Role::STORE)->first();
        $storePermissions   = Permission::whereIn('name', Permission::$storePermissionList)->get()->pluck('id');
        $store->syncPermissions($storePermissions);

        dd("DoneEverything");
    }

    public function password_reset($hashid)
    {
;
        $PasswordLink = PasswordLink::where('hash',$hashid)->first();

        
        if($PasswordLink){
            $user;
            // if($PasswordLink->type=="store"){
                $user =  User::where('email',$PasswordLink->email)->first();
            // } else {
            //     $user = DeliveryPartner::where('email',$PasswordLink->email)->first();
            // }
            
            return view('password', compact('user','PasswordLink'));
            
        }
        
        
        
        
        
        
        // $data['title'] = 'Dashboard';
        // return view('home', $data);
    }
    public function password_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hash'=>'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);
    
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
            
        } else {
            $store = User::where('email',$request->email)->first();
            $store->password = bcrypt($request->password);
            $store->save();
            // return redirect(route('login'))->with('success','You have Password Changed successfully');
            
            return redirect("/login")->with('status', 'Your Password has be updated');

        }
    }

    /**
     * 
     */
    public function fetchAddressUsingPincode(Request $request)
    {
        $data['table'] = 1;
        if ($request->id) {
            $data['table']  = 0;
            $data['city']   = City::find($request->id);
            $data['drop']   = $request->drop;

            return response()->json([
                'html' => view('admin.cities.partials.fetch-cities', $data)->render()
            ]);
        } else {

            $value = $request->value ? $request->value : $request->drop_value;

            $this->_save_cities($value);

            $data['select_class_name'] = $request->value ? 'address-choose' : 'drop-address-choose';
            if ($value) {
                $data['cities'] = City::where('pincode', 'like', $value . '%');

                if (strlen($value) < 6) {
                    $data['cities']->limit(5);
                }
        
                $data['cities'] = $data['cities']->get();
        
                return response()->json([
                    'html' => view('admin.cities.partials.fetch-cities', $data)->render()
                ]);
            }
            
        }
        
    }

    protected function _save_cities($pincode) {
        $apiUrl     = "https://api.data.gov.in/resource/5c2f62fe-5afa-4119-a499-fec9d604d5bd";
        $apiKey     = "579b464db66ec23bdd000001d3640efb1e0646846203c80f14708228";
        $format     = "json";
        $pincode    = $pincode;
        // Prepare the complete URL with query parameters
        $url = sprintf("%s?api-key=%s&format=%s&filters[pincode]=%s", $apiUrl, $apiKey, $format, $pincode);

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL and other options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session
        $response = curl_exec($ch);

        // Check if there was an error
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
            return null;
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $responseData = json_decode($response, true);

        if (!empty($responseData['records'])) {
            foreach ($responseData['records'] as $data) {
                State::firstOrCreate([
                    'name' => $data['statename']
                ]);

                $state = State::where('name', $data['statename'])->first();

                City::firstOrCreate([
                    'state_id'  => $state->id,
                    'area'      => $data['officename'],
                    'city'      => $data['district'],
                    'latitude'  => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'pincode'   => $data['pincode']
                ]);
            }
        }
    }
}
