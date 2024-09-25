<?php

namespace App\Controllers;

use App\Models\CurrencyModel;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function root($path = '')
    {
        if ($path !== '') {
            if(@file_exists(APPPATH.'Views/'.$path.'.php')) {
                return view($path);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            echo 'Page Not Found.';
        }
    }
}
