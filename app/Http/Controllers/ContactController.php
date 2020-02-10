<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class ContactController extends BaseController
{
    public function index ()
    {

      $data = 'Halo Dunia';

      // dd($data);

      return response
      ([
        'success' => true,
        'data' => $data
      ]);

    }
}
