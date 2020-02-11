<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

  public function index ()
  {
    // json
    $out = array(
      'success' => true,
      'message' => 'Request Accepted.'
    );

    return response()->json($out, 200);
  }

}
