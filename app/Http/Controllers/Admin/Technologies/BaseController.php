<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Technology;
use App\Services\TechnologiesService;

class BaseController extends Controller
{
    public $service;

    public function __construct(TechnologiesService $service)
    {
        $this->service = $service;
    }
}
