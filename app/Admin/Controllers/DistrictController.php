<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Illuminate\Support\Facades\DB;

use App\Models\DistrictTw;

class DistrictController extends Controller
{
    public function cascading (Request $request, Content $content)
    {
        $content->title('多層次選擇');

        $form = new Form($request->all());
        $form->method('GET');
        $form->action('/examples/district');

        $form->disableSubmit();
        $form->disableReset();

        $form->select('city', '縣市')->options(
            DistrictTw::groupBy('city_id', 'city')->pluck('city', 'city_id')
        )->load('area', '/admin/examples/district/area');

        $form->select('area', '區域');

        $content->row(new Box('Form', $form));
        return $content;

    }

    /**
     * 取得指定縣市之區域
     *
     * @param Request $request
     * @return void
     */
    public function getArea(Request $request)
    {
        $cityId = $request->get('q') ?? null;

        $areas = DistrictTw::where("city_id", $cityId)
            ->orderBy("display_order")
            ->select(DB::raw("id, area as text"))
            ->get()
            ->toArray();

        return response()->json($areas);
    }
}
