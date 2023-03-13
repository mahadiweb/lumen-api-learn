<?php

$router->get('/', function(){
	return response("Hello World!");
});

//$router->get('/','HomeController@redirect');

$router->get('/name[/{name}]', function($name=null){
	return $name;
});

$router->get('con/{id}', 'HomeController@index');

$router->post('/post', function(){
	return response("Post");
});

$router->get('/dbtest','HomeController@dbtest');


//Todo
$router->get('/Read[/{id}]',['middleware'=>'auth','uses'=>'Crud\Todo@Read']);
$router->post('/Create','Crud\Todo@Create');
$router->put('/Update',['middleware'=>'auth','uses'=>'Crud\Todo@Update']);
$router->delete('/Delete','Crud\Todo@Delete');

$router->post('/login','Crud\Todo@Login');