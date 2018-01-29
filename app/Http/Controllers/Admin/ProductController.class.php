<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ApiController;

class ProductController extends ApiController
{
    /**
     * 列表
     * author  mhl,
     * date    2018-01-29 09:07:29,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ProductsObj = Product::orderBy('id', 'desc')
        // 关联表
        ->with('galleries');
        // 表查询
        $ProductsObj->when($request->title, function ($query) use ($request) {
                $query->where('title', '=', $request->title );
            });
        $Products = $ProductsObj->paginate(15);

        $rows = [];
        foreach ($Products as $k => $Product) {
            $rows[$k] = [
                    'product_id' => $Product->id,
                    'category_id' => $Product->category_id,
                    'location_id' => $Product->location_id,
                    'brand_id' => $Product->brand_id,
                    'thumbnail' => $Product->thumbnail,
                    'title' => $Product->title,
                    'sub_title' => $Product->sub_title,
                    'keywords' => $Product->keywords,
                    'description' => $Product->description,
                    'price_origin' => $Product->price_origin,
                    'price' => $Product->price,
                    'price_express' => $Product->price_express,
                    'point_max' => $Product->point_max,
                    'sale_min' => $Product->sale_min,
                    'sale_max' => $Product->sale_max,
                    'storage' => $Product->storage,
                    'unit' => $Product->unit,
                    'is_top' => $Product->is_top,
                    'is_hot' => $Product->is_hot,
                    'is_new' => $Product->is_new,
                    'is_recommend' => $Product->is_recommend,
                ];
            // 关联字段
            $row[$k]['gallery_images'] = $Product->galleries->pluck('image')->toArray() ?? 0;
        }



        $data = [
            'currentPage' => $Products->currentPage(),
            'perPage' => $Products->perPage(),
            'total' => $Products->total(),
            'lastPage' => $Products->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', R_OK, $data);
    }

    /**
     * 获取创建页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('club.add');
    }

    /**
     * 保存添加内容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'city_name' => 'required',
            'city_code' => 'required',
            'club_name' => 'required',
        ], [
            'city_name.required' => '城市名称必须填。',
            'city_code.required' => '城市区号代码必须填。',
            'club_name.required' => '会所名字必须填。'
        ])->validate();

        $club = Club::orderBy('id', 'desc')->select('club_code')->first();

        $club_code = (int)$club->club_code + 1;

        Club::create([
            'city_name' => $request->old('city_name'),
            'city_code' => $request->old('city_code'),
            'club_name' => $request->old('club_name'),
            'club_code' => $club_code,
        ]);

        return \Redirect::back()->withInput()->withErrors("添加成功");
    }

}
