<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/28
 * Time: 上午9:19
 */
namespace Admin\Controller;
use Think\Controller;

class ImageController extends Controller
{
    public function ajaxuploadimage()
    {
        $upload = D('UploadImage');
        //res是上传成功后的图片绝对路径
        $res = $upload->imageUpload();
        if ($res === false)
        {
            return send(0,'上传失败');
        }
        else
        {
            return send(1,'上传成功',$res);
        }
    }
}