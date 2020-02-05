<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class KapalController extends BaseController
{
    public function index ()
    {

      $data = 'Hallo World';

      dd($data);

      return response
      ([
        'success' => true,
        'data' => $data
      ]);

    }
}
