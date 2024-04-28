<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;

class ConfigurationController extends Controller
{
    public function index()
    {   
        $data['title'] = 'Configuration';

        $data['statesCount'] = State::count();
        $data['citiesCount'] = City::count();
        
        return view('admin.configurations.index', $data);
    }
}
