<?php

namespace App\Http\Controllers;

use App\Mail\User\PasswordMail;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use YouTube\Exception\YouTubeException;
use YouTube\YouTubeDownloader;

class Test extends Controller
{
    /**
     * Выборка связи
     */
    public function rel()
    {
        $rows = Technology::with('users')->where('id', '=', 1)->first();
        dd($rows->users->id);
    }

    /**
     * Отправка почты
     */
    public function mailSend()
    {
        $password = 123;
        Mail::to('i-litovan@yandex.ru')->send(new PasswordMail($password));
    }

    /**
     * Загрузка видео с ютуба
     */
    public function youTubeDownloader()
    {
        $youtube = new YouTubeDownloader();

        try {
            $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=QklAPHcAQR4");

            if ($downloadOptions->getAllFormats()) {
                $allFormats = $downloadOptions->getAllFormats();
                foreach ($allFormats as $keyFormat => $objFormat) {
//                    if ($objFormat->qualityLabel == '"hd720"') {
//                        $link = $downloadOptions->getFirstCombinedFormat()->url;
                    $link = $objFormat->url;
//                    $content = file_get_contents($link);
//                    file_put_contents(public_path('videos/test.mp4'), $content);
                    dd($link);
//                    }
                }
            } else {
                echo 'No links found';
            }

        } catch (YouTubeException $e) {
            echo 'Something went wrong: ' . $e->getMessage();
        }

        return 1;
    }
}
