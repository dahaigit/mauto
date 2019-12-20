<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * @Desc: 切片上传文件
     *
     * @param Request $request
     * @return mixed
     */
    public function sliceUpload(Request $request)
    {
        $file = $request->file('file');
        $blob_num = $request->get('blob_num');
        $total_blob_num = $request->get('total_blob_num');
        $file_name = $request->get('file_name');

        $realPath = $file->getRealPath(); //临时文件的绝对路径

        // 存储地址
        $path = 'slice/'.date('Ymd')  ;
        $filename = $path .'/'. $file_name . '_' . $blob_num;

        //上传
        $upload = Storage::disk('local')->put($filename, file_get_contents($realPath));

        //判断是否是最后一块，如果是则进行文件合成并且删除文件块
        $isFirst = 1;
        if($blob_num == $total_blob_num){
            for($i=1; $i<= $total_blob_num; $i++){
                $blob = Storage::disk('local')->get($path.'/'. $file_name.'_'.$i);
//              Storage::disk('admin')->append($path.'/'.$file_name, $blob);   //不能用这个方法，函数会往已经存在的文件里添加0X0A，也就是\n换行符
                $savePath = public_path('uploads').'/'.$path.'/';
                if (!is_dir($savePath)) {
                    mkdir($savePath, 0777, true);
                }
                file_put_contents(public_path('uploads').'/'.$path.'/'.$file_name,$blob,FILE_APPEND);
            }
            //合并完删除文件块
            for($i=1; $i<= $total_blob_num; $i++){
                Storage::disk('local')->delete($path.'/'. $file_name.'_'.$i);
            }
        }

        if ($upload){
            return json_encode([
                'status' => 200,
                'message' => '上传成功',
            ]);
        }else{
            return json_encode([
                'status' => 0,
                'message' => '上传失败',
            ]);
        }
    }

    /**
     * Notes: 队列+长连接上传图片
     * User: mhl
     * @param Request $request
     */
    public function queueUpload(Request $request)
    {
        dd($request);
    }

}
