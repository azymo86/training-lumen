<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends BaseController
{

    public function SaveInventory (Request $request)
    {
      // validation
      $this->validate($request,[
         'name'  => 'required',
         'price' => 'required'
      ]);

      // insert data
      $table = new Inventory;
      $table->name  = $request->name;
      $table->price = $request->price;
      $table->save();

      // showing data save
      $data = Inventory::latest()->first();

      // json
      $out = array(
        'success' => true,
        'data' => $data
      );

      return response()->json($out, 200);
    }

    public function ListInventory ()
    {
      $raw  = Inventory::OrderBy("id", "DESC");
      $data = $raw
      ->select('id','name','price')
      ->paginate(10)
      ;

      // json
      $out = array(
        'success' => true,
        'data' => $data
      );

      return response()->json($out, 202);
    }

}
