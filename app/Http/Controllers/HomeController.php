<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\TechnologyModel;

class HomeController extends Controller
{
//    use AuthorizesRequests;
//    use DispatchesJobs;
//    use ValidatesRequests;

    public function index(Request $request)
    {
        return view('home', [
            'pageTitle' => 'Главная',
            'pageHeader' => 'IT-заметки',
            'row' => [
                'id' => 0,
                'parent_id' => 0,
                'sorting' => 0
            ]
        ]);
    }

    public function tech(int $id = 0)
    {
        $model = TechnologyModel::find($id);
        return view('home', [
            'pageTitle' => $model->name,
            'pageHeader' => $model->name,
            'back_id' => $model->parent_id,
            'row' => $model
        ]);
    }

    public function add(int $parent_id = 0, int $sorting = 0, Request $request)
    {
        if ($request->input('name') !== null) {
            $model = new TechnologyModel;
            $model->parent_id = $parent_id;
            $model->name = $request->input('name');
            $model->branch_stop_flag = intval($request->input('branch_stop_flag'));
            $model->is_page_flag = intval($request->input('is_page_flag'));
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
        $model = TechnologyModel::find($id);
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
}
