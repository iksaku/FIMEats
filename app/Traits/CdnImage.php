<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

trait CdnImage
{
    /**
     * @param string|null $img
     * @return string
     */
    public function getImage($img): string
    {
        if (!empty($img)) {
            $path = 'img/'.$img;

            try {
                if (Storage::cloud()->has($path)) {
                    return Storage::cloud()->url($path);
                }

                return Storage::cloud()->url('img/food_placeholder.jpg');
            } catch (InvalidArgumentException $exception) {
                if (file_exists(public_path($path))) {
                    return asset($path);
                }
            }
        }

        return asset('img/food_placeholder.jpg');
    }
}
