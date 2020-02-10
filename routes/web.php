<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Generate Application Key
// $router->get('/key', function()
// {
//     return \Illuminate\Support\Str::random(32);
// });

// lets start
$router->get('/', 'TestController@index');

// Tester Area
$router->group(['prefix' => '/test'], function ($router) {
  $router->get('/kapal', 'KapalController@index');
  $router->post('/req','TestController@postRequest');
});

$router->group(['prefix' => '/easycamp'], function ($router) {
      // init Contact
      $router->get('','ContactController@index');
      $router->get('/inventory', 'InventoryController@ListInventory');
      $router->post('/inventory/save', 'InventoryController@SaveInventory');
});
