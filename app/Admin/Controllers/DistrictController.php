<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

use App\Models\DistrictTw;

class DistrictController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('縣市區域選擇器')
            ->description('範例')
            ->body(new Box('', view('district')));
    }


    /**
     * 取得縣市
     *
     * @return void
     */
    public function getCity()
    {
        $cities = DistrictTw::orderBy("display_order")
                ->groupBy("city_id", "city", "display_order")
                ->select("city_id", "city")
                ->get()
                ->toArray();

        return response()->json($cities);
    }

    /**
     * 取得指定縣市之區域
     *
     * @param Request $request
     * @return void
     */
    public function getArea(Request $request)
    {
        $cityId = $request->input("city_id") ?? null;

        $areas = DistrictTw::where("city_id", $cityId)
            ->orderBy("display_order")
            ->select("id", "area")
            ->get()
            ->toArray();

        return response()->json($areas);
    }
}
