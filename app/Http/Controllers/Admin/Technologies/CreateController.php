<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Technology;
use App\Http\Requests\Technologies\CreateRequest;

class CreateController extends BaseController
{
    public function __invoke(int $parent_id = 0, int $sorting = 0, Request $request)
    {
//        TODO доработать CRUD по конвенции
//        TODO Request (валидация)
//        TODO Передача $data в сервис
//        $data = $request->validated();
//        Technology::firstOrCreate($data);
        if ($request->input('name') !== null) {
            $this->service->create(
                $request->input('name'),
                $parent_id,
                intval($request->input('branch_stop_flag')),
                intval($request->input('is_page_flag'))
            );
            if ($parent_id > 0) {
                return redirect()->route('tech', ['id' => $parent_id])
                    ->with('success', 'Добавлено: ' . $request->input('name'));
            } else {
                return redirect()->route('home')
                    ->with('success', 'Добавлено: ' . $request->input('name'));
            }
        }
        return view('admin.technologies.create', [
            'pageTitle' => 'Добавить запись'
        ]);
    }
}
