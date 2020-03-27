<?php

require "./vendor/autoload.php";
require "./class/cattree.php";

use NoahBuscher\Macaw\Macaw;

Macaw::get('/index', "controller\Test@index");
Macaw::get('/index/hello', "controller\Test@hello");

//显示管理页面
Macaw::get('/', "controller\Home@index");
//分类管理页面
Macaw::get('/catelist', "controller\Category@index");
Macaw::post('/category/order', "controller\Category@order");
Macaw::post('/category/doadd', "controller\Category@doadd");
Macaw::get('/category/add', "controller\Category@toadd");
Macaw::post('/category/doupdate', "controller\Category@doupdate");
Macaw::get('/category/toupdate', "controller\Category@toupdate");
Macaw::get('/category/todelete', "controller\Category@todelete");
//图书管理页面
Macaw::get('/booklist', "controller\Book@index");
Macaw::post('/book/doadd', "controller\Book@doadd");
Macaw::get('/book/add', "controller\Book@toadd");
Macaw::post('/book/doupdate', "controller\Book@doupdate");
Macaw::get('/book/toupdate', "controller\Book@toupdate");
Macaw::get('/book/todelete', "controller\Book@todelete");

Macaw::dispatch();

// echo "123";
// // Macaw::get('/', 'Controllers\demo@index');
// // Macaw::get('page', 'Controllers\demo@page');
// // Macaw::get('view/(:num)', 'Controllers\demo@view');

// Macaw::get('/view/(:any)', function ($slug) {
//   echo 'The slug is: ' . $slug;
// });
// Macaw::get('/', function () {
//   echo 'welcome to the index page~';
// });
// Macaw::get('/hello', function () {
//   echo 'hello world!';
// });
