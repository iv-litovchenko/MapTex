<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Models\Technology;

class EditController extends BaseController
{
    public function __invoke(int $id = 0, Request $request)
    {
        $model = Technology::find($id);
        if ($request->input('name') !== null) {
            $model->name = $request->input('name');
            $model->description = $request->input('description');
            $model->description_tinymce = $request->input('description_tinymce');
            $model->branch_stop_flag = intval($request->input('branch_stop_flag'));
            $model->is_page_flag = intval($request->input('is_page_flag'));
            $model->is_draft_flag = intval($request->input('is_draft_flag'));
            $model->sorting = intval($request->input('sorting'));

            if ($request->file()) {
                $file = $request->file('logo_image');
                $destinationPath = 'images/logos/' . $id . '/';
                $file->move($destinationPath, $file->getClientOriginalName());
//                $model->logo_image = Storage::disk('public')->put('/images', 'content???');
                $model->logo_image = 'images/logos/' . $id . '/' . $file->getClientOriginalName();
            }

            $model->save();
        }
        return view('admin.technologies.edit', [
            'pageTitle' => 'Обновить запись',
            'model' => $model
        ]);
    }
}
