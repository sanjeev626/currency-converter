<?php

namespace App\Controllers;

use App\Models\CountryModel;

class CountryController extends BaseController
{
    public function index()
    {
        // Load the model
        $countryModel = new CountryModel();

        // Fetch data
        $data['countries'] = $countryModel->getCountries();

        // Pass data to the view
        return view('countries_view', $data);
    }
}
