<?php
namespace App\Http\Controllers\API;

use App\Models\Classe;
use App\Common\Contract\Code;
use Illuminate\Http\Request;

class ClasseController extends ApiController
{
    /**
     * 班级表列表
     * author  孟海龙,
     * date    2018-03-07 06:52:09,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classeBuilder = Classe::orderBy('id', 'desc');
        $classes = $classeBuilder->paginate(15);

        $rows = [];
        foreach ($classes as $k => $classe) {
            $rows[$k] = [
                    'classe_id' => $classe->id,
                    'grade_name' => $classe->grade_name,
                    'alias_name' => $classe->alias_name,
                    'number' => $classe->number,
                    'year' => $classe->year,
                    'status' => $classe->status,
                ];
        }

        $data = [
            'currentPage' => $classes->currentPage(),
            'perPage' => $classes->perPage(),
            'total' => $classes->total(),
            'lastPage' => $classes->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
    * 班级表详情

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $classe = Classe::findOrFail($id);

        $data = [
            'classe_id' => $classe->id,
            'grade_name' => $classe->grade_name,
            'alias_name' => $classe->alias_name,
            'number' => $classe->number,
            'year' => $classe->year,
            'status' => $classe->status,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加班级表
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
'grade_name' => 'required|max:255',
'alias_name' => 'max:255',
'number' => 'required|numeric',
'year' => 'required|max:4',
'status' => 'in',        ], [
            
'grade_name.required' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_GRADE_NAME_NOT_EMPTY),
'grade_name.max' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_GRADE_NAME_MAX),
'alias_name.max' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_ALIAS_NAME_MAX),
'number.required' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_NUMBER_NOT_EMPTY),
'number.numeric' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_NUMBER_NOT_NUMERIC),
'year.required' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_YEAR_NOT_EMPTY),
'year.max' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_YEAR_MAX),
'status.in:0,1' => $this->ruleMsg(Code::E_SCHOOL_CLASSE_STATUS_NOT_IN),        ])->validator();

        \DB::beginTransaction();
        try {
            Classe::create([
                'grade_name' => $request->grade_name,
                'alias_name' => $request->alias_name,
                'number' => $request->number,
                'year' => $request->year,
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
    * 删除班级表
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Classe::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
