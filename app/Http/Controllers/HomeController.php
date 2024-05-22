<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\store;
use App\Models\DeliveryPartner;
use App\Models\PasswordLink;
use Illuminate\Support\Facades\Validator;
use App\User;

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
    public function password_reset(Request $request,$id)
    {
        
        $PasswordLink = PasswordLink::where('hash',$id)->first();
        
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
    public function fetchAddressUsingPincode(Request $request) {
        
        $data['table'] = 1;
        if ($request->id) {
            $data['table']  = 0;
            $data['city']   = City::find($request->id);
            return response()->json([
                'html' => view('admin.cities.partials.fetch-cities', $data)->render()
            ]);
        } else {
            $data['cities'] = City::where('pincode', 'like', $request->value . '%');

            if (strlen($request->value) < 6) {
                $data['cities']->limit(5);
            }
    
            $data['cities'] = $data['cities']->get();
    
            return response()->json([
                'html' => view('admin.cities.partials.fetch-cities', $data)->render()
            ]);
        }
        
    }
}
