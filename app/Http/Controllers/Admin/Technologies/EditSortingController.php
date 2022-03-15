<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Technology;

class EditSortingController extends BaseController
{
    public function __invoke(int $id = 0, Request $request)
    {
        $model = Technology::find($id);
        if (is_array($request->input('sort_list'))) {
            foreach ($request->input('sort_list') as $postId => $postNewSort) {
                $modelUpdate = Technology::find($postId);
                $modelUpdate->sorting = intval($postNewSort);
                $modelUpdate->save();
            }
        }
        $rows = Technology::where('parent_id', '=', $model->id)->orderBy('sorting')->get();
        return view('admin.technologies.edit-sorting', [
            'pageTitle' => 'Обновить сортировку',
            'model' => $model,
            'rows' => $rows
        ]);
    }
}
