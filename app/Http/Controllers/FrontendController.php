<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use App\Models\Technology;
use App\Models\Note;
use App\Models\User;

class FrontendController extends BaseController
{
//    use AuthorizesRequests;
//    use DispatchesJobs;
//    use ValidatesRequests;

    public function index(Request $request)
    {
        return view('frontend', [
            'pageTitle' => 'Главная',
            'pageHeader' => 'Roadmap backend',
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
        $path = public_path('images/posts/' . $model->id);
        if (File::exists($path)) {
            $files = File::files($path);
        }

        return view('frontend', [
            'pageTitle' => $model->name,
            'pageHeader' => $model->name,
            'back_id' => $model->parent_id,
            'row' => $model,
            'files' => $files
        ]);
    }

    public function login(Request $request)
    {
        $postUserId = $request->input('id');
        $postUserEmail = $request->input('email');
        $postUserPassword = $request->input('password');
        if ($postUserId > 0) {
            $row = User::find($postUserId);
//            dd(md5($row->password) . ".|." . md5($postUserPassword));
            if ($row->email == $postUserEmail
                &&
                $row->password == md5($postUserPassword)
            ) {
                $cookie = Cookie::forever('BACKEND_OPEN', 'yes');
                return response()
                    ->view('frontend-login-successfully')
                    ->withCookie($cookie);
            }
        }
        return view('frontend-login');
    }

    public function pics()
    {
        $path = public_path('images/pics');
        $files = File::files($path);

        return view('frontend-pics', [
            'pageTitle' => 'Разные картинки',
            'files' => $files
        ]);
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forever('BACKEND_OPEN', 'no');
        return redirect()
            ->route('home')
            ->withCookie($cookie);
    }

    public function books()
    {
        $path = public_path('images/books');
        $files = File::files($path);

        return view('frontend-books', [
            'pageTitle' => 'Книги',
            'files' => $files
        ]);
    }

    public function notes(Request $request)
    {
        // Проверка на авторизацию
        $backendOpenStatus = Cookie::get('BACKEND_OPEN');
        $inputBodytext = $request->input('bodytext');
        if ($inputBodytext != '') {
            $model = new Note;
            $model->bodytext = $inputBodytext;
            if($backendOpenStatus === 'yes'){
                $model->is_me = 1;
            }
            $model->save();
            return redirect()->route('notes');
        }

        $rows = Note::orderBy('id', 'desc')->get();
        return view('frontend-notes', [
            'pageTitle' => 'Барахолка',
            'rows' => $rows
        ]);
    }

    public function search(Request $request)
    {
        $inputQuerySearch = $request->input('q');
        $queryLike = $inputQuerySearch;
        $queryLike = '%' . str_ireplace(' ', '_', $queryLike) . '%';

        $rows = [];
        if ($inputQuerySearch != '') {
            $rows = Technology::where('name', 'like', $queryLike)
                ->orWhere('description', 'like', $queryLike)
                ->get();
        }

        return view('frontend-search', [
            'pageTitle' => 'Поиск по сайту',
            'q' => $inputQuerySearch,
            'searchResult' => $rows
        ]);
    }
}
