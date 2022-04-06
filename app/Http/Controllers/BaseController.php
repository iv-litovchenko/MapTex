<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Services\FileAttachDetachService;

abstract class BaseController extends Controller
{
    /** @var App\Services\FileAttachDetachService */
    public $fileAttachDetachService;

    public function __construct()
    {
        $this->fileAttachDetachService = new FileAttachDetachService();
    }
}
