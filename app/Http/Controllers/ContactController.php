<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Contact;

class ContactController extends BaseController
{
    public function index ()
    {

      $data = 'data';

      // dd($data);

      return response
      ([
        'success' => true,
        'data' => $data
      ]);

    }
}
