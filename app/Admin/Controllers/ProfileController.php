<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

class ProfileController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('個人簡介')
            ->description('檢視')
            ->body(new Box('', view('profile')));
    }
}
