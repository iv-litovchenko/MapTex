<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Technology;

class CreateController extends BaseController
{
    public function __invoke(int $parent_id = 0, int $sorting = 0, Request $request)
    {
        if ($request->input('name') !== null) {
            $model = new Technology;
            $model->parent_id = $parent_id;
            $model->name = $request->input('name');
            $model->branch_stop_flag = intval($request->input('branch_stop_flag'));
            $model->is_page_flag = intval($request->input('is_page_flag'));
            $model->is_draft_flag = 0;
            $model->save();
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
