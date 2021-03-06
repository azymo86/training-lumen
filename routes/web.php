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
$router->get('/', 'Controller@index');

// Tester Area
$router->group(['prefix' => '/test'], function ($router) {
  $router->get('/', 'TestController@index');
  $router->post('/req','TestController@postRequest');
  $router->post('/random','TestController@generateRandom');
  $router->post('/post','TestController@receive');
  $router->post('/register','TestController@register');
  $router->post('/login','TestController@login');
});

$router->group(['prefix' => '/easycamp'], function ($router) {
      // init Contact
      $router->get('','Controller@index');
      $router->get('/inventory', 'InventoryController@ListInventory');
      $router->get('/inventory/{id}', 'InventoryController@DetailInventory');
      $router->post('/inventory-save', 'InventoryController@SaveInventory');
      $router->post('/inventory-update', 'InventoryController@UpdateInventory');
});


$router->group(['middleware' => 'user'], function ($router) {
    $router->get('/auth', 'TestController@index');
});


























//
