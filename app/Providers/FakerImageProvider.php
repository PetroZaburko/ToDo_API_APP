<?php

namespace App\Providers;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FakerImageProvider extends Base
{
    public function loremflickr($dir = '', $width = 640, $height = 480)
    {
        $name = $dir . '/' . Str::random(6) . '.jpg';

        Storage::disk('attachments')->put(
            $name,
            file_get_contents("https://loremflickr.com/$width/$height")
            );

        return $name;
    }
}
