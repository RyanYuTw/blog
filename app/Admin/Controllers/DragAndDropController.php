<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;

use App\Models\{TblTask, TblStatus};

class DragAndDropController extends Controller
{
    public function index(Content $content)
    {
        // 取得工作狀態
        $statusResult = TblStatus::all();
        // 取得各工作內容及目前狀態
        $taskRows = TblTask::leftJoin('tbl_status', 'tbl_task.status_id', '=', 'tbl_status.id')
                            ->select('tbl_task.id', 'tbl_task.title', 'tbl_status.id as status_id', 'tbl_status.status_name')
                            ->get();

        // 工作內容及目前狀態輸出格式轉換
        $taskResult = [];
        foreach ($taskRows as $taskRow) {
            $taskResult[$taskRow->status_id][] = [
                'id'          => $taskRow->id,
                'title'       => $taskRow->title,
                'status_name' => $taskRow->status_name,
            ];
        }

        return $content
            ->title('待辦事項拖拉')
            ->description('檢視')
            ->body(new Box('', view('drag_drop', [
                    'statusResult' => $statusResult,
                    'taskResult'   => $taskResult
                    ])
                ));
    }

    /**
     * 更新事項狀態
     *
     * @param Request $request
     * @return void
     */
    public function statusUpdate(Request $request)
    {
        $statusId = $request->input("status_id") ?? null;
        $taskId = $request->input("task_id") ?? null;

        $tblTaskObj = TblTask::find($taskId);
        $tblTaskObj->status_id = $statusId;
        $tblTaskObj->save();

        $result = [
            'code'    => 200,
            'status'  => true,
            'message' => '資料更新成功!',
        ];

        return response()->json($result);
    }
}
