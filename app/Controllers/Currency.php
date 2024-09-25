<?php

namespace App\Controllers;

use App\Models\CurrencyModel;
use App\Models\CountryModel;

class Currency extends BaseController {
    public function index() {
        $countryModel = new CountryModel();
        $data['countries'] = $countryModel->getCountries();
        return view('currency-add', $data); // Make sure the view file is named correctly
    }

    public function save() { 
        // Start the session
        $session = session();
    
        $currencyModel = new CurrencyModel();
        $conversionRates = $this->request->getPost('conversion_rate');
        
        // Initialize a flag to track if any rates were saved
        $ratesSaved = false;
    
        if (!empty($conversionRates)) {
            foreach ($conversionRates as $key => $rate) { 
                if (!empty($rate)) {
                    $currency_code = $this->request->getPost('currency_code')[$key];
                    $country = $this->request->getPost('country')[$key];
                    $conversion_date = date('Y-m-d');
                    
                    // Check if the record exists
                    if (!$currencyModel->checkExistingRecord($country, $conversion_date)) {
                        //echo "Insert";
                        // Prepare data for insertion
                        $data = [
                            'country' => $this->request->getPost('country')[$key],
                            'currency' => $this->request->getPost('currency')[$key],
                            'currency_code' => $currency_code,
                            'conversion_rate' => $rate,
                            'conversion_date' => $conversion_date,
                        ];
                        // Insert new conversion data
                        $currencyModel->insertConversions($data);
                    } else {
                        //echo "Update";
                        // Update existing conversion data
                        $currencyModel->updateConversions($country, $conversion_date, $rate);
                    }
    
                    // Set the flag to true since we processed at least one valid rate
                    $ratesSaved = true;
                }
            }
        }
    
        // Set flash message based on whether any rates were saved
        if ($ratesSaved) {
            $session->setFlashdata('message', 'Conversion rates saved successfully.');
            return redirect()->back();
        } else {
            $session->setFlashdata('message', 'No conversion rates provided.');
            return redirect()->back();
        }
    
    }
    // public function save() {
    //     $currencyModel = new CurrencyModel();
    //     $countryModel = new CountryModel();
        
    //     // Get the submitted conversion rates
    //     $conversionRates = $this->request->getPost('conversion_rate');
    //     // print_r($_POST);
    //     echo "I'm here";
    //     // // Fetch the countries
    //     // $countries = $countryModel->getCountries();
    //     // $date = date('Y-m-d');

    //     foreach ($_POST['conversion_rate'] as $index => $rate) {
    //         echo $rate."<br>";
    //     //     if (isset($conversionRates[$index])) {
    //     //         $data = [
    //     //             'country' => $country['country'],
    //     //             'currency_code' => $country['currency_code'],
    //     //             'conversion_rate' => $conversionRates[$index],
    //     //             'conversion_date' => $date,
    //     //         ];

    //     //         // Attempt to insert data and check for errors
    //     //         if (!$currencyModel->insert($data)) {
    //     //             return redirect()->back()->with('error', 'Failed to save conversion rates for ' . esc($country['country']));
    //     //         }
    //     //     }
    //     }

    //     // return redirect()->to(base_url('currency'))->with('message', 'Conversion rates saved successfully!');
    // }
}