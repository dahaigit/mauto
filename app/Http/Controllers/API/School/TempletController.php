<?php
namespace App\Http\Controllers\API\School;

use App\Models\Templet;
use App\Common\Contract\Code;
use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;

class TempletController extends ApiController
{
/**
* 模板表列表
* author  孟海龙,
* date    2018-07-11 13:20:14,
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
        $templetBuilder = Templet::orderBy('id', 'desc');
        $templets = $templetBuilder->paginate(15);

        $rows = [];
        foreach ($templets as $k => $templet) {
            $rows[$k] = [
                    'templet_id' => $templet->id,
    'name' => $templet->name,
    'category_id' => $templet->category_id,
    'body' => $templet->body,
    'weight' => $templet->weight,
];
}

$data = [
'page' => $templets->currentPage(),
'take' => $templets->perPage(),
            'total' => $templets->total(),
            'lastPage' => $templets->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
    * 模板表详情

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $templet = Templet::findOrFail($id);

        $data = [
            'templet_id' => $templet->id,
            'name' => $templet->name,
            'category_id' => $templet->category_id,
            'body' => $templet->body,
            'weight' => $templet->weight,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加模板表
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
'name' => 'required|max:255',
'category_id' => 'required|numeric',
'body' => 'required',
'weight' => 'in',
        ], [
'name.required' => Code::E_School_TEMPLET_NAME_NOT_EMPTY,
'name.max' => Code::E_School_TEMPLET_NAME_MAX,
'category_id.required' => Code::E_School_TEMPLET_CATEGORY_ID_NOT_EMPTY,
'category_id.numeric' => Code::E_School_TEMPLET_CATEGORY_ID_NOT_NUMERIC,
'body.required' => Code::E_School_TEMPLET_BODY_NOT_EMPTY,
'weight.in:0,1' => Code::E_School_TEMPLET_WEIGHT_NOT_IN,
        ])->validate();

        \DB::beginTransaction();
        try {
            Templet::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'body' => $request->body,
                'weight' => $request->weight,
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
const E_School_TEMPLET_NAME_NOT_EMPTY = 100000;
const E_School_TEMPLET_NAME_MAX = 100001;
const E_School_TEMPLET_CATEGORY_ID_NOT_EMPTY = 100002;
const E_School_TEMPLET_CATEGORY_ID_NOT_NUMERIC = 100003;
const E_School_TEMPLET_BODY_NOT_EMPTY = 100004;
const E_School_TEMPLET_WEIGHT_NOT_IN = 100005;
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
Code::E_School_TEMPLET_NAME_NOT_EMPTY => '模板名称不能为空！',
Code::E_School_TEMPLET_NAME_MAX => '模板名称不能超过255个字符',
Code::E_School_TEMPLET_CATEGORY_ID_NOT_EMPTY => '模板分类ID id@cateories不能为空！',
Code::E_School_TEMPLET_CATEGORY_ID_NOT_NUMERIC => '模板分类ID id@cateories必须是一个数字',
Code::E_School_TEMPLET_BODY_NOT_EMPTY => '不能为空！',
Code::E_School_TEMPLET_WEIGHT_NOT_IN => '模板排序',
        ";
    }

    /**
    * 删除模板表
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Templet::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
