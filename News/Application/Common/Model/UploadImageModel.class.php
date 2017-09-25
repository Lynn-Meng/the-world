<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/28
 * Time: 上午9:46
 */

namespace Common\Model;

use Think\Exception;
use Think\Model;

class UploadImageModel extends Model
{
    private $_uploadObj = '';
    private $_uploadImageData = '';
    const UPLOAD = 'upload';

    public function __construct()
    {
        $this->_uploadObj = new \Think\Upload();
        $this->_uploadObj->rootPath = './' . self::UPLOAD . '/';
        //设置文件夹层次
        $this->_uploadObj->subName = date(Y) . '/' . date(m) . '/' . date(d);
        //./upload/2017/08/28
    }

    public function imageUpload()
    {

        $res = $this->_uploadObj->upload();
        if ($res) {
            return '/' . self::UPLOAD . '/' . $res['file']['savepath'] . $res['file']['savename'];
        } else {
            return false;
        }


    }
}