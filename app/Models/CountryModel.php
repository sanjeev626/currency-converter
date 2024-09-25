<?php

namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model {
    protected $table      = 'country';   // Your country table
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'country', 'currency', 'currency_code'];

    public function getCountries() {
        return $this->findAll();
    }
}