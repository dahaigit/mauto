<?php
namespace App\Http\Controllers\API\School;

use App\Models\Categorie;
use App\Common\Contract\Code;
use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;

class CategorieController extends ApiController
{
/**
* 模板分类表列表
* author  孟海龙,
* date    2018-07-11 13:53:29,
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
        $categorieBuilder = Categorie::orderBy('id', 'desc');
        $categories = $categorieBuilder->paginate(15);

        $rows = [];
        foreach ($categories as $k => $categorie) {
            $rows[$k] = [
                    'categorie_id' => $categorie->id,
    'name' => $categorie->name,
    'weight' => $categorie->weight,
];
}

$data = [
'page' => $categories->currentPage(),
'take' => $categories->perPage(),
            'total' => $categories->total(),
            'lastPage' => $categories->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
    * 模板分类表详情

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);

        $data = [
            'categorie_id' => $categorie->id,
            'name' => $categorie->name,
            'weight' => $categorie->weight,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加模板分类表
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
'name' => 'required|max:255',
'weight' => 'in',
        ], [
'name.required' => Code::E_Message_CATEGORIE_NAME_NOT_EMPTY,
'name.max' => Code::E_Message_CATEGORIE_NAME_MAX,
'weight.in:0,1' => Code::E_Message_CATEGORIE_WEIGHT_NOT_IN,
        ])->validate();

        \DB::beginTransaction();
        try {
            Categorie::create([
                'name' => $request->name,
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
const E_Message_CATEGORIE_NAME_NOT_EMPTY = 100000;
const E_Message_CATEGORIE_NAME_MAX = 100001;
const E_Message_CATEGORIE_WEIGHT_NOT_IN = 100002;
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
Code::E_Message_CATEGORIE_NAME_NOT_EMPTY => '分类名称不能为空！',
Code::E_Message_CATEGORIE_NAME_MAX => '分类名称不能超过255个字符',
Code::E_Message_CATEGORIE_WEIGHT_NOT_IN => '分类排序',
        ";
    }

    /**
    * 删除模板分类表
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Categorie::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
