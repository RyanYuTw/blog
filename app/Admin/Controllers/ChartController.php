<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

use App\Models\TblPeopleCountry;
use StdClass;
use DB;

class ChartController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('統計圖表')
            ->description('檢視')
            ->body(view('pie'))
            ->body(view('chart'))
            ->body(view('line'));
    }

    /**
     * 取得國籍統計資料
     *
     * @return void
     */
    public function loadData()
    {
        return TblPeopleCountry::groupBy("Country")
                    ->select(DB::raw('Country, count(Name) as people_cnt'))
                    ->get();

    }

    /**
     * 取得長條圖資料
     *
     * @return void
     */
    public function chart()
    {
        $peopleCountries = $this->loadData();

        $dataColumn = ['國籍人數'];
        $dataSeries = [];

        if (!$peopleCountries->isEmpty()) {
            foreach ($peopleCountries as $row)
            {
                $obj = new StdClass();

                $obj->name = $row->Country;
                $obj->data = [
                    $row->people_cnt,
                ];
                $dataSeries[] = $obj;
            }
        }

        return response()->json([
            'chartType'   => 'column',
            'title'       => '國籍統計',
            'sidetitle'   => '人數',
            'bottomtitle' => '國籍',
            'dataColumn'  => $dataColumn,
            'dataSeries'  => $dataSeries,
        ]);

    }

    /**
     * 取得圓餅圖資料
     *
     * @return void
     */
    public function pie()
    {
        $peopleCountries = $this->loadData();
        $totle = $peopleCountries->sum('people_cnt') ?? 0;

        $dataSeries = array();

        if (!$peopleCountries->isEmpty()) {
            foreach ($peopleCountries as $row)
            {
                $obj = new StdClass();
                $obj->name = $row->Country;
                $obj->data = $row->people_cnt;
                $obj->y = (float) round($row->people_cnt * 100 / $totle, 2);

                $dataSeries[] = $obj;
            }
        }

        return response()->json([
            'title' => '國籍統計',
            'dataSeries' => $dataSeries,
            'seriesName' => '人數',
        ]);
    }


    /**
     * 取得線形圖資料
     *
     * @return void
     */
    public function line()
    {
        $peopleCountries = $this->loadData()->toArray() ?? [];

        if (count($peopleCountries) > 0) {

            $dataSeries = []; // 線條
            $dataColumn = array_column($peopleCountries, 'Country'); // x軸

            //建立查詢區間圖表輸出資料
            // 日期:資料 mapping
            $funcToInt = function($v){return (int)$v;};
            $peopleCnt      = array_map($funcToInt, array_column($peopleCountries, 'people_cnt'));

            $dataSeries = [
                ["name" => '人數', "data" => $peopleCnt],
            ];

            return response()->json([
                'title'       => '國籍統計',
                'sidetitle'   => '人數',
                'bottomtitle' => '國籍',
                'dataColumn'  => $dataColumn,
                'dataSeries'  => $dataSeries,
            ]);
        }

    }

}
