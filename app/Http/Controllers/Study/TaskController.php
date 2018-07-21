<?php

namespace App\Http\Controllers\Study;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * 列表
     * author  孟海龙,
     * date    2018-07-15 18:16:49,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taskBuilder = Task::orderBy('id', 'desc');
        $tasks = $taskBuilder->get();

        $rows = [];
        foreach ($tasks as $k => $task) {
            $rows[$k] = [
                'task_id' => $task->id,
                'body' => $task->body,
                'project_id' => $task->project_id,
            ];
        }

        return \Response::json([
                'message' => '请求成功',
                'data' => $rows
            ]);
    }

    /**
     * 详情

     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        $data = [
            'task_id' => $task->id,
            'body' => $task->body,
            'project_id' => $task->project_id,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            Task::create([
                'body' => $request->body,
                'project_id' => $request->project_id,
            ]);

            \DB::commit();
            return \Response::json([
                'message' => '添加成功'
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }


    /**
     * 删除
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
