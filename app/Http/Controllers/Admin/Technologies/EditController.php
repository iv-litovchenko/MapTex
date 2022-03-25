<?php

namespace App\Http\Controllers\Admin\Technologies;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

            // загрузка 1 файла (логотип)
            if ($file = $request->file('logo_image')) {
                $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $fileName = strtolower($fileName);
                $destinationPath = 'uploads/image/logo/' . $id . '/';
                $file->move($destinationPath, $fileName);
                $model->logo_image = $destinationPath . $fileName;
//                $model->logo_image = Storage::disk('public')->put('/images', 'content???');
            }

            $model->save();

            // загрузка картинок в папку (в базу не пишем)
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                    $fileName = strtolower($fileName);
                    $destinationPath = 'uploads/image/post/' . $id . '/';
                    $file->move($destinationPath, $fileName);
                }
            }
        }

        $images = [];
        $path = public_path('uploads/image/post/' . $id . '/');
        if (File::exists($path)) {
            $images = File::files($path);
        }

        return view('admin.technologies.edit', [
            'pageTitle' => 'Обновить запись',
            'model' => $model,
            'images' => $images
        ]);
    }
}
