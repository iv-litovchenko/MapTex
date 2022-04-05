<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller
{
    public $servicePost;
    // public $serviceFilePublic;

    public function __construct()
    {
        // $this->servicePost = new PostService();
        // $this->serviceFilePublic = new FilePublicService();
    }
}
