<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Services\PostsService;

class BaseController extends Controller
{
    public $service;

    public function __construct(PostsService $service)
    {
        $this->service = $service;
    }
}
