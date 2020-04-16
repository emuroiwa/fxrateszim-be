<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hdtuto', function() {

    $crawler = Goutte::request('GET', 'https://www.marketwatch.co.zw');

    $crawler->filter('#tablepress-4 tr td')->each(function ($node) {

      dump($node->text());

    });

});
