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

        $posts = Post::select('id', 'name', 'maptex_content_link')->whereNotNull('maptex_content_link')->get()->keyBy('maptex_content_link');
        return view('admin.post.maptexcontentsynchroniz', compact(
                'filesList',
                'posts'
            )
        );
    }

    public function update(Request $request)
    {
        // Post::where('id', '>', 0)->update([
        //     'maptex_content_link' => '',
        //     'maptex_content_save' => ''
        // ]);
        $syncFiles = $request->input('sync');
        foreach ($syncFiles as $fileName => $id) {
            if ($id > 0) {
                if ($post = Post::find($id)) {
                    $post->maptex_content_link = $fileName;
                    $post->maptex_content_save = file_get_contents("https://raw.githubusercontent.com/iv-litovchenko/maptex_content/master/" . rawurlencode($fileName));
                    $post->save();
                } else {
                    // $request->session()->flash('flash_messages_success', 'Запись с ID [' . $id . '] не найдена!');
                }
            }
        }
        $request->session()->flash('flash_messages_success', 'Данные успешно обновлены');
        return redirect()->route('admin.post.maptexcontentsync');
    }
}
