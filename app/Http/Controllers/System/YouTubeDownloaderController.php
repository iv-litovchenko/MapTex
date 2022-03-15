<?php

namespace App\Http\Controllers\System;

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

class YouTubeDownloaderController
{
    public function __invoke()
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
