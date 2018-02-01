<?php
namespace App\Http\Controllers\API;

use App\Models\Product;
use BenbenLand\Contracts\Code;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * 列表
     * author  mhl,
     * date    2018-02-01 10:02:29,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productBuilder = Product::orderBy('id', 'desc');
        $products = $productBuilder->paginate(15);

        $rows = [];
        foreach ($products as $k => $product) {
            $rows[$k] = [
                    'product_id' => $product->id,
                    'category_id' => $product->category_id,
                    'location_id' => $product->location_id,
                    'brand_id' => $product->brand_id,
                    'thumbnail' => $product->thumbnail,
                    'title' => $product->title,
                    'sub_title' => $product->sub_title,
                    'keywords' => $product->keywords,
                    'description' => $product->description,
                    'price_origin' => $product->price_origin,
                    'price' => $product->price,
                    'price_express' => $product->price_express,
                    'point_max' => $product->point_max,
                    'sale_min' => $product->sale_min,
                    'sale_max' => $product->sale_max,
                    'storage' => $product->storage,
                    'unit' => $product->unit,
                    'is_top' => $product->is_top,
                    'is_hot' => $product->is_hot,
                    'is_new' => $product->is_new,
                    'is_recommend' => $product->is_recommend,
                ];
        }

        $data = [
            'currentPage' => $products->currentPage(),
            'perPage' => $products->perPage(),
            'total' => $products->total(),
            'lastPage' => $products->lastPage(),
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
        $product = Product::findOrFail($id);

        $data = [
            'product_id' => $product->id,
            'category_id' => $product->category_id,
            'location_id' => $product->location_id,
            'brand_id' => $product->brand_id,
            'thumbnail' => $product->thumbnail,
            'title' => $product->title,
            'sub_title' => $product->sub_title,
            'keywords' => $product->keywords,
            'description' => $product->description,
            'price_origin' => $product->price_origin,
            'price' => $product->price,
            'price_express' => $product->price_express,
            'point_max' => $product->point_max,
            'sale_min' => $product->sale_min,
            'sale_max' => $product->sale_max,
            'storage' => $product->storage,
            'unit' => $product->unit,
            'is_top' => $product->is_top,
            'is_hot' => $product->is_hot,
            'is_new' => $product->is_new,
            'is_recommend' => $product->is_recommend,
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
        $validator = \Validator::make($request->all(), [
'category_id' => 'required|numeric',
'location_id' => 'numeric',
'brand_id' => 'required|numeric',
'thumbnail' => 'required|max:255',
'title' => 'required|max:255',
'sub_title' => 'required|max:255',
'keywords' => 'required|max:255',
'description' => 'required',
'price_origin' => 'required',
'price' => 'required',
'point_max' => 'numeric',
'sale_min' => 'numeric',
'sale_max' => 'numeric',
'storage' => 'numeric',
'unit' => 'max:255',
'is_top' => 'in:0,1',
'is_hot' => 'in:0,1',
'is_new' => 'in:0,1',
'is_recommend' => 'in:0,1',        ], [
            
'category_id.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_CATEGORY_ID_NOT_EMPTY),
'category_id.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_CATEGORY_ID_NOT_NUMERIC),
'location_id.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_LOCATION_ID_NOT_NUMERIC),
'brand_id.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_BRAND_ID_NOT_EMPTY),
'brand_id.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_BRAND_ID_NOT_NUMERIC),
'thumbnail.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_THUMBNAIL_NOT_EMPTY),
'thumbnail.max' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_THUMBNAIL_MAX),
'title.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_TITLE_NOT_EMPTY),
'title.max' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_TITLE_MAX),
'sub_title.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_SUB_TITLE_NOT_EMPTY),
'sub_title.max' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_SUB_TITLE_MAX),
'keywords.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_KEYWORDS_NOT_EMPTY),
'keywords.max' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_KEYWORDS_MAX),
'description.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_DESCRIPTION_NOT_EMPTY),
'price_origin.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_PRICE_ORIGIN_NOT_EMPTY),
'price.required' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_PRICE_NOT_EMPTY),
'point_max.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_POINT_MAX_NOT_NUMERIC),
'sale_min.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_SALE_MIN_NOT_NUMERIC),
'sale_max.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_SALE_MAX_NOT_NUMERIC),
'storage.numeric' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_STORAGE_NOT_NUMERIC),
'unit.max' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_UNIT_MAX),
'is_top.in:0,1' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_IS_TOP_NOT_IN),
'is_hot.in:0,1' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_IS_HOT_NOT_IN),
'is_new.in:0,1' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_IS_NEW_NOT_IN),
'is_recommend.in:0,1' => $this->ruleMsg(Code::E_PRODUCT_PRODUCT_IS_RECOMMEND_NOT_IN),        ]);
        $this->validatorErrors($validator);

        \DB::beginTransaction();
        try {
            WechatMessage::create([
                'category_id' => $request->category_id,
                'location_id' => $request->location_id,
                'brand_id' => $request->brand_id,
                'thumbnail' => $request->thumbnail,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'keywords' => $request->keywords,
                'description' => $request->description,
                'price_origin' => $request->price_origin,
                'price' => $request->price,
                'price_express' => $request->price_express,
                'point_max' => $request->point_max,
                'sale_min' => $request->sale_min,
                'sale_max' => $request->sale_max,
                'storage' => $request->storage,
                'unit' => $request->unit,
                'is_top' => $request->is_top,
                'is_hot' => $request->is_hot,
                'is_new' => $request->is_new,
                'is_recommend' => $request->is_recommend,
                ]);

            \DB::commit();
            return $this->apiResponse('添加成功！', Code::R_OK);
        } catch (\Exception $e) {
            \DB::rollBack();
            dd($e);
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
        Product::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
