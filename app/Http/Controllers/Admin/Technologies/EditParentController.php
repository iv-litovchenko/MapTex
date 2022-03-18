<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Technology;

class EditParentController extends BaseController
{
    public function __invoke(int $id = 0, Request $request)
    {
        $model = Technology::find($id);
        $inputParentId = $request->input('parent_id');
        if (isset($inputParentId)) {
            $model->parent_id = $inputParentId > 0 ? $inputParentId : null;
            $model->save();
        }
        return view('admin.technologies.edit-parent-id', [
            'pageTitle' => 'Обновить родителя',
            'model' => $model
        ]);
    }
}
