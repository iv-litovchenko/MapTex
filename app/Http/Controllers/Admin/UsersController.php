<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //GET|HEAD     |user              |user.index      |App\Http\Controllers\Admin\UsersController@index|web|
    //GET|HEAD     |user/{user}       |user.show       |App\Http\Controllers\Admin\UsersController@show|web|
    //GET|HEAD     |user/create       |user.create     |App\Http\Controllers\Admin\UsersController@create|web|
    //POST         |user              |user.store      |App\Http\Controllers\Admin\UsersController@store|web|
    //GET|HEAD     |user/{user}/edit  |user.edit       |App\Http\Controllers\Admin\UsersController@edit|web|
    //PUT|PATCH    |user/{user}       |user.update     |App\Http\Controllers\Admin\UsersController@update|web|
    //DELETE       |user/{user}       |user.destroy    |App\Http\Controllers\Admin\UsersController@destroy|web|
    public function index()
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }
}
