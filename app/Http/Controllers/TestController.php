<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class TestController extends BaseController
{
    public function index ()
    {
      return response
      ([
        'success' => true,
        'data' => 'kamu sukses'
      ]);
    }
}
