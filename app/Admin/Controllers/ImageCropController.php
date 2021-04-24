<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

use App\Models\{TblTask, TblStatus};

class ImageCropController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('影像裁切')
            ->description('檢視')
            ->body(new Box('', view('image_crop')));
    }

    /**
     * 影像裁切
     *
     * @param Request $request
     * @return void
     */
    public function imageCrop(Request $request)
    {
        $img    = "../public".$request->input('img');
        $width  = $request->input('w');
        $height = $request->input('h');
        $x      = $request->input('x');
        $y      = $request->input('y');

        $img_r = imagecreatefromjpeg($img);
        $dst_r = ImageCreateTrueColor($width, $height);

        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $width, $height, $width, $height);
        header('Content-type: image/jpeg');

        $output = '../public/img/img_crop_tmp.jpg';
        imagejpeg($dst_r, $output);

        imagedestroy($img_r);
        imagedestroy($dst_r);

        $result = [
            'status' => true,
            'target' => str_replace("../public", "", $output),
        ];

        return $result;
    }
}
