<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Technology;

class BackendController extends BaseController
{
    public function add(int $parent_id = 0, int $sorting = 0, Request $request)
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
        return view('backend-add');
    }

    public function update(int $id = 0, Request $request)
    {
        $model = Technology::find($id);
        if ($request->input('name') !== null) {
            $model->name = $request->input('name');
            $model->description = $request->input('description');
            $model->branch_stop_flag = intval($request->input('branch_stop_flag'));
            $model->is_page_flag = intval($request->input('is_page_flag'));
            $model->is_draft_flag = intval($request->input('is_draft_flag'));
            $model->sorting = intval($request->input('sorting'));
            $model->save();
        }
        return view('backend-update', ['model' => $model]);
    }

    public function updateSorting(int $id = 0, Request $request)
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
        return view('backend-update-sorting', ['model' => $model, 'rows' => $rows]);
    }
}
