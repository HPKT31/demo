<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\PaymentController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/api/payment/create', 'PaymentController::createOrder');