<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\AdminTechnologyStoreRequest;
use App\Models\Technology;

/**
 * Контроллер - главная страница административного раздела
 */
class DashboardController extends Controller
{
    /**
     * Вывод списка модулей
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('admin.dashboard');
    }
}
