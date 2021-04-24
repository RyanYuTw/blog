<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

use DataTables;

use App\Models\TblContact;

class DataTableController extends Controller
{
    public function index(Content $content)
    {

        return $content
            ->title('資料表格')
            ->description('搜尋')
            ->body(new Box('', view('datatable')));
    }

    public function getData()
    {
        $tblContacts = TblContact::all();
        $output = DataTables::of($tblContacts)->make(true);

        return $output;

    }
}
