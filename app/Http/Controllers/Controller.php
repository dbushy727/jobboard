<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($logo, $height = 200, $width = 200)
    {
        $filepath = storage_path(time() . $logo->getClientOriginalName());

        \Image::make($logo)->fit($height, $width)->save($filepath);

        return $filepath;
    }
}
