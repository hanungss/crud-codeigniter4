<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Post::index');
$routes->get('/create', 'Post::create');
$routes->post('/store', 'Post::store');
$routes->get('/edit', 'Post::edit');
$routes->post('/update', 'Post::update');
$routes->get('/delete', 'Post::delete');