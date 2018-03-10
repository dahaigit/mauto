<?php
namespace App\Http\Controllers\API;

use App\Models\Teacher;
use App\Common\Contract\Code;
se App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;

class TeacherController extends ApiController
{
    /**
     * 教师表列表
     * author  孟海龙,
     * date    2018-03-10 06:54:37,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teacherBuilder = Teacher::orderBy('id', 'desc');
        $teachers = $teacherBuilder->paginate(15);

        $rows = [];
        foreach ($teachers as $k => $teacher) {
            $rows[$k] = [
                    'teacher_id' => $teacher->id,
                    'school_id' => $teacher->school_id,
                    'user_id' => $teacher->user_id,
                    'teacher_title_id' => $teacher->teacher_title_id,
                    'status' => $teacher->status,
                ];
        }

        $data = [
            'currentPage' => $teachers->currentPage(),
            'perPage' => $teachers->perPage(),
            'total' => $teachers->total(),
            'lastPage' => $teachers->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
    * 教师表详情

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        $data = [
            'teacher_id' => $teacher->id,
            'school_id' => $teacher->school_id,
            'user_id' => $teacher->user_id,
            'teacher_title_id' => $teacher->teacher_title_id,
            'status' => $teacher->status,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加教师表
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'school_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'teacher_title_id' => 'required|numeric',
            'status' => 'in',
        ], [
            'school_id.required' => Code::E_SCHOOL_TEACHER_SCHOOL_ID_NOT_EMPTY,
            'school_id.numeric' => Code::E_SCHOOL_TEACHER_SCHOOL_ID_NOT_NUMERIC,
            'user_id.required' => Code::E_SCHOOL_TEACHER_USER_ID_NOT_EMPTY,
            'user_id.numeric' => Code::E_SCHOOL_TEACHER_USER_ID_NOT_NUMERIC,
            'teacher_title_id.required' => Code::E_SCHOOL_TEACHER_TEACHER_TITLE_ID_NOT_EMPTY,
            'teacher_title_id.numeric' => Code::E_SCHOOL_TEACHER_TEACHER_TITLE_ID_NOT_NUMERIC,
            'status.in:0,1' => Code::E_SCHOOL_TEACHER_STATUS_NOT_IN,
        ])->validator();

        \DB::beginTransaction();
        try {
            Teacher::create([
                'school_id' => $request->school_id,
                'user_id' => $request->user_id,
                'teacher_title_id' => $request->teacher_title_id,
                'status' => $request->status,
                ]);

            \DB::commit();
            return $this->apiResponse('添加成功！', Code::R_OK);
        } catch (\Exception $e) {
            \DB::rollBack();
            dd($e);
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
const E_SCHOOL_TEACHER_SCHOOL_ID_NOT_EMPTY = 100000;
const E_SCHOOL_TEACHER_SCHOOL_ID_NOT_NUMERIC = 100001;
const E_SCHOOL_TEACHER_USER_ID_NOT_EMPTY = 100002;
const E_SCHOOL_TEACHER_USER_ID_NOT_NUMERIC = 100003;
const E_SCHOOL_TEACHER_TEACHER_TITLE_ID_NOT_EMPTY = 100004;
const E_SCHOOL_TEACHER_TEACHER_TITLE_ID_NOT_NUMERIC = 100005;
const E_SCHOOL_TEACHER_STATUS_NOT_IN = 100006;
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
Code::E_SCHOOL_TEACHER_SCHOOL_ID_NOT_EMPTY => '学校ID @schools.id不能为空！',
Code::E_SCHOOL_TEACHER_SCHOOL_ID_NOT_NUMERIC => '学校ID @schools.id必须是一个数字',
Code::E_SCHOOL_TEACHER_USER_ID_NOT_EMPTY => '用户ID @users.id不能为空！',
Code::E_SCHOOL_TEACHER_USER_ID_NOT_NUMERIC => '用户ID @users.id必须是一个数字',
Code::E_SCHOOL_TEACHER_TEACHER_TITLE_ID_NOT_EMPTY => '老师职位ID @teacher_titles.id不能为空！',
Code::E_SCHOOL_TEACHER_TEACHER_TITLE_ID_NOT_NUMERIC => '老师职位ID @teacher_titles.id必须是一个数字',
Code::E_SCHOOL_TEACHER_STATUS_NOT_IN => '状态 1:在职 2:离职',
        ";
    }

    /**
    * 删除教师表
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Teacher::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
