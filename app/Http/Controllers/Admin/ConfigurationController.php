<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\category;
use App\Models\cure_disease;

class ConfigurationController extends Controller
{
    public function index()
    {   
        $data['title'] = 'Configuration';

        $data['statesCount'] = State::count();
        $data['citiesCount'] = City::count();
        $data['categoryCount'] = category::count();
        $data['curediseaseCount'] = cure_disease::count();
        
        return view('admin.configurations.index', $data);
    }
}
