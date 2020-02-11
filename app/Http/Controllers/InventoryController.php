<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends BaseController
{
    // Create
    public function SaveInventory (Request $request)
    {
      // validation
      $this->validate($request,[
        'name'  => 'required',
        'price' => 'required|integer'
      ]);

      // get file image
      $file = $request->file('url_image');

      // cek url_image
      if ($request->url_image == null || $request->url_image == "") {
        $url_image = "/upload/images/empty.jpg";
      }
      else {
        // rename and uploading image
        $folder    = 'upload/images';
        $filename  = 'easycamp-'.rand().'.'.$file->getClientOriginalExtension();
        $url_image = '/'.$folder.'/'.$filename;
        $file->move($folder,$filename); // upload
      }

      // insert data
      $table = new Inventory;
      $table->name      = $request->name;
      $table->price     = $request->price;
      $table->url_image = $url_image;
      $table->save();

      // showing data save
      $data = Inventory::latest()->first();

      // set url app
      $data->url_image = env("APP_URL").$data->url_image;

      // json
      $out = array(
        'success' => true,
        'data' => $data
      );

      return response()->json($out, 200);
    }

    // Readlist
    public function ListInventory (Request $request)
    {
      // get data from database
      $raw  = Inventory::OrderBy("id", "ASC");
      $data = $raw
        ->select('id','name','price','url_image')
        ->paginate($request->per_page)
      ;

      // set url app
      for ($i=0; $i < count($data) ; $i++) {
        $data[$i]->url_image = env("APP_URL").$data[$i]->url_image;
      }

      // json
      $out = array(
        'success' => true,
        'data' => $data
      );

      return response()->json($out, 200);
    }

    // ReadOne
    public function DetailInventory (Request $request, $id)
    {

      // showing data save
      $data = Inventory::find($id);

      // set url app
      $data->url_image = env("APP_URL").$data->url_image;

      // json
      $out = array(
        'success' => true,
        'data' => $data
      );

      return response()->json($out, 200);
    }

    // Update
    public function UpdateInventory (Request $request)
    {
      // validation
      $this->validate($request,[
          'id'    => 'required',
          'name'  => 'required',
          'price' => 'required|integer'
      ]);

      // showing data save
      $data = Inventory::find($request->id);

      // json
      $out = array(
        'success' => true,
        'data' => $data
      );

      return response()->json($out, 200);
    }

}
