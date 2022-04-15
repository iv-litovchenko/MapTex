<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

/**
 * Контроллер - создать бэкап
 */
class BackupController extends BaseController
{
    /**
     * Создание бэкапа через команду (одноименный контроллер)
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function __invoke(Request $request)
    {
        Artisan::call('backup:run');
        $request->session()->flash('flash_messages_success', 'Бэкап успешно создан!');
        return redirect()->back();
    }
}
