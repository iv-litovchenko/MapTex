<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;

/**
 * Контроллер для обработки страниц frontend-а
 */
class SiteController extends Controller
{
    //    use AuthorizesRequests;
    //    use DispatchesJobs;
    //    use ValidatesRequests;

    /**
     * Главная страница
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $path = public_path('uploads/image/home');
        $images = File::files($path);

        return view('site.home', [
            'images' => $images,
            'row' => [
                'id' => 0,
                'parent_id' => 0,
                'sorting' => 0
            ]
        ]);
    }

    public function tech(int $id = 0)
    {
        $model = Technology::find($id);

        $files = [];
        $path = public_path('uploads/image/post/' . $model->id);
        if (File::exists($path)) {
            $files = File::files($path);
        }

        return view('site.tech', [
            'back_id' => $model->parent_id,
            'row' => $model,
            'files' => $files
        ]);
    }

    /**
     * Страница разных картинок
     *
     * @return \Illuminate\View\View
     */
    public function pic()
    {
        $path = public_path('uploads/image/pic');
        $images = File::files($path);
        return view('site.pic', compact('images'));
    }


    /**
     * Страница список книг
     *
     * @return \Illuminate\View\View
     */
    public function book()
    {
        $path = public_path('uploads/image/book');
        $images = File::files($path);
        return view('site.book', compact('images'));
    }

    /**
     * Страница барахолка
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function note(Request $request)
    {
        // Проверка на авторизацию
        $backendOpenStatus = Cookie::get('BACKEND_OPEN');
        $inputBodytext = $request->input('bodytext');
        if ($inputBodytext != '') {
            $model = Note::make();
            $model->bodytext = $inputBodytext;
            if ($backendOpenStatus === 'yes') {
                $model->is_me = 1;
            }
            $model->save();
            return redirect()->route('notes');
        }

        $rows = Note::orderBy('id', 'desc')->paginate(3);
        return view('site.note', [
            'rows' => $rows
        ]);
    }

    /**
     * Страница поиска по сайту
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $inputQuerySearch = $request->input('q');
        $queryLike = $inputQuerySearch;
        $queryLike = '%' . str_ireplace(' ', '_', $queryLike) . '%';

        $rows = [];
        if ($inputQuerySearch != '') {
            $rows = Technology::where('name', 'like', $queryLike)
                ->orWhere('description', 'like', $queryLike)
                ->orderBy('parent_id', 'asc')
                ->orderBy('sorting', 'asc')
                ->get();
        }

        return view('site.search', [
            'q' => $inputQuerySearch,
            'searchResult' => $rows
        ]);
    }

}
