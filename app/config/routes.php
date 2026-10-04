<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/
/** @var object $router **/

$router->get('/', 'Welcome::index');
$router->get('/student', 'StudentController::index');
$router->get('/users', 'UsersController::index');
$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::authenticate');
$router->post('/logout', 'AuthController::logout');

$router->options('/api/login', 'ApiController::preflight');
$router->options('/api/logout', 'ApiController::preflight');
$router->options('/api/products', 'ApiController::preflight');
$router->options('/api/products/{id}', 'ApiController::preflight');
$router->post('/api/login', 'ApiController::login');
$router->post('/api/logout', 'ApiController::logout');
$router->get('/api/products', 'ApiController::index');
$router->post('/api/products', 'ApiController::store');
$router->get('/api/products/{id}', 'ApiController::show');
$router->put('/api/products/{id}', 'ApiController::update');
$router->patch('/api/products/{id}', 'ApiController::update');
$router->delete('/api/products/{id}', 'ApiController::delete');

$router->get('/create-migration/{migration_class}', 'MigrationController::create_migration');
$router->get('/migrate', 'MigrationController::migrate');
$router->get('/rollback', 'MigrationController::rollback');
$router->get('/rollback-all', 'MigrationController::rollback_all');
$router->get('/refresh', 'MigrationController::refresh');
$router->get('/status', 'MigrationController::status');

$router->group(['middleware' => 'student_access'], function ($router) {
	$router->get('/student/profile', 'StudentController::profile');
});

$router->group(['middleware' => 'auth'], function ($router) {
	$router->get('/products', 'ProductsController::index');
	$router->group(['middleware' => 'admin'], function ($router) {
	$router->get('/products/create', 'ProductsController::create');
	$router->post('/products', 'ProductsController::store');
	$router->get('/products/edit/{id}', 'ProductsController::edit');
	$router->post('/products/edit/{id}', 'ProductsController::update');
	$router->post('/products/delete/{id}', 'ProductsController::delete');
	});
});