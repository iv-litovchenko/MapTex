<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Post;
use Illuminate\Http\Request;

class PostMaptexContentSynchronizeController extends BaseController
{
    public function __invoke()
    {
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];
        $context = stream_context_create($opts);
        $filesList = file_get_contents('https://api.github.com/repos/iv-litovchenko/maptex_content/git/trees/master', false, $context);
        $filesList = json_decode($filesList)->tree;

        $posts = Post::select('id', 'maptex_content_link')->whereNotNull('maptex_content_link')->get()->keyBy('maptex_content_link');
        return view('admin.post.maptexcontentsynchroniz', compact(
                'filesList',
                'posts'
            )
        );
    }

    public function update(Request $request)
    {
        // ..$post->post_type = $request->input('post_type') ? $request->input('post_type') : null;
        $request->session()->flash('flash_messages_success', 'Данные успешно обновлены');
        return redirect()->route('admin.post.maptexcontentsync');
    }
}
