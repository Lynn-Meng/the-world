<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/23
 * Time: 下午7:27
 */
namespace Common\Model;
use Think\Model;

class NewsModel extends Model
{
    private $_dbc = '';
    function __construct()
    {
        parent::__construct();
        $this->_dbc = M('news');
    }
    public function getAllNewsContent($data = array())
    {

        if (isset($data['title']) && $data['title'])
        {
            $dataCon['title'] = array('like','%'.$data['title'].'%');
        }
        else
        {
            $dataCon = null;
        }
        if ($data['catid'])
        {
            $dataCon['catid'] = $data['catid'];
        }
        $dataCon['status']  = array('neq',-1);
        $res = $this->_dbc->where($dataCon)->order('listorder desc,news_id desc')->select();
        return $res;
    }
    public function changeStatusById($data)
    {
        if (!is_array($data) || !$data)
        {
            return 0;
        }
        $dataCon['status'] = $data['status'];
        $res =  $this->_dbc->where('news_id='.$data['common_id'])->save($dataCon);
        return $res;
    }

    public function updateListorder($key,$value)
    {
        if (!is_numeric($key) || !is_numeric($value))
        {
            return 0;
        }
        $dataCon = array(
              'listorder' => $value
        );
        $res = $this->_dbc->where('news_id='.$key)->save($dataCon);
        return $res;
    }
    public function getOneRowById($id)
    {
        $res = $this->_dbc->where('news_id='.$id)->find();
        return $res;
    }
    public function insert($data = array())
    {
        if (!is_array($data) || (!$data))
        {
            return 0;
        }
        if (!$data['create_time'])
        {
            $data['create_time'] = time();
        }
        return $res =  $this->_dbc->add($data);

    }
    public function getThreePic()
    {
        $res = $this->_dbc->limit(0,3)->order('listorder desc,news_id desc')->select();
        return $res;
    }

}
