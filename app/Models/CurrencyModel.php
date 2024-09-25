<?php

namespace App\Models;

use CodeIgniter\Model;

class CurrencyModel extends Model 
{
    protected $table      = 'currency_conversion';   // Table name
    protected $primaryKey = 'id';                     // Primary key

    protected $allowedFields = ['id', 'country', 'currency', 'currency_code', 'conversion_rate', 'conversion_date'];

    // Function to get all products
    public function getConversions()
    {
        return $this->findAll();
    }

    // Function to get a product by ID
    public function getConversionById($id)
    {
        return $this->find($id); // Returns a single record by ID
    }
    
    // Function to get today's records
    public function getTodayConversions()
    {
        // Get today's date
        $today = date('Y-m-d');

        // Query the table where conversion_date is today's date
        return $this->where('conversion_date', $today)->findAll();
    }
    
    public function getConversionsByDate($date)
    {
        // Query the table where conversion_date is today's date
        return $this->where('conversion_date', $date)->findAll();
    }

    public function getConversionsBetweenTwoDate($date1, $date2)
    {
        // Query the table where currency conversion between two dates
        return $this->where('conversion_date >=', $date1)
                    ->where('conversion_date <=', $date2)
                    ->findAll();
    }

    // Check if a record exists based on currency_code and date
    public function checkExistingRecord($country, $date) {
        return $this->where('country', $country)
                    ->where('conversion_date', $date)
                    ->first();
    }
    
    // Insert new conversion data
    public function insertConversions($data) {
        return $this->insert($data);
    }

    // Update existing conversion data
    public function updateConversions($country, $conversion_date, $rate) {
        //echo $country.' --- '.$conversion_date.' --- '.$rate;
        $this->set('conversion_rate', $rate)
         ->where('country', $country)
         ->where('conversion_date', $conversion_date)
         ->update();
        // return $this->set('conversion_rate', $rate)
        //             ->where('currency_code', $currency_code)
        //             ->where('conversion_date', $date)
        //             ->update();
        //echo $this->db->getLastQuery(); echo "<br>";
    }

    public function getCurrencyRate($country,$date)
    {
        /*$this->select('conversion_rate');
        $this->from('currency_conversion');
        $this->where('currency_code', $currency_code);
        $this->where('conversion_date', $date);
        $query = $this->db->get();

        // Fetch the single result
        if ($query->num_rows() > 0) {
            return $query->row()->conversion_rate;
        } else {
            return false; // or null, if no result found
        }*/
        $currency = $this->select('conversion_rate')
                     ->where('country', $country)
                     ->where('conversion_date', $date)
                     ->first(); // Using first() to fetch a single record
        //echo $this->db->getLastQuery(); echo "<br>";
        // Check if a record was found
        if ($currency) {
            // Access as array if it returns an array
            return $currency['conversion_rate'];
        } else {
            // Handle the case where no record is found (return null or a default value)
            return null;
        }
    }
    
}
