<?php
namespace App\Http\Controllers\API\School;

use App\Models\Task;
use App\Common\Contract\Code;
use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;

class TaskController extends ApiController
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
        $tasks = $taskBuilder->paginate(15);

        $rows = [];
        foreach ($tasks as $k => $task) {
            $rows[$k] = [
                    'task_id' => $task->id,
    'body' => $task->body,
    'project_id' => $task->project_id,
];
}

$data = [
'page' => $tasks->currentPage(),
'take' => $tasks->perPage(),
            'total' => $tasks->total(),
            'lastPage' => $tasks->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
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
        \Validator::make($request->all(), [
'body' => 'required|max:255',
'project_id' => 'numeric',
        ], [
'body.required' => Code::E_School_TASK_BODY_NOT_EMPTY,
'body.max' => Code::E_School_TASK_BODY_MAX,
'project_id.numeric' => Code::E_School_TASK_PROJECT_ID_NOT_NUMERIC,
        ])->validate();

        \DB::beginTransaction();
        try {
            Task::create([
                'body' => $request->body,
                'project_id' => $request->project_id,
                ]);

            \DB::commit();
            return $this->apiResponse('添加成功！', Code::R_OK);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
    * 错误常量，使用过后请删除
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function validatorConst()
    {
        $const = "
const E_School_TASK_BODY_NOT_EMPTY = 100000;
const E_School_TASK_BODY_MAX = 100001;
const E_School_TASK_PROJECT_ID_NOT_NUMERIC = 100002;
        ";
    }

    /**
    * 错误消息，使用过后请删除
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function validatorMsg()
    {
        $msg = "
Code::E_School_TASK_BODY_NOT_EMPTY => '不能为空！',
Code::E_School_TASK_BODY_MAX => '不能超过255个字符',
Code::E_School_TASK_PROJECT_ID_NOT_NUMERIC => '必须是一个数字',
        ";
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
