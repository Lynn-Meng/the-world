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

    public function getThreePic()
    {
        $res = $this->_dbc->limit(0,3)->order('listorder desc,news_id desc')->select();
        return $res;
    }
    public function addOneRow($data)
    {
        $dataCon = $data;
        $dataCon['listorder'] = 0;
        $dataCon['update_time'] = time();
        $dataCon['create_time'] = time();
        $dataCon['status'] = 1;
        $dataCon['count'] = 0;
        $dataCon['username'] = getAdminNameToIndex();
        $res = $this->_dbc->add($dataCon);
        return $res;
    }
    public function edit()
    {

    }
    public function getNewsListByCount()
    {
        $res = $this->_dbc->limit(0,4)->order('count desc')->select();
        return $res;
    }
    public function getOneRoById($id)
    {
        if (!is_numeric($id) || !$id)
        {
            return 0;
        }
        return $this->_dbc->where('news_id='.$id)->find();
    }
    public function EditOneRow($id,$data)
    {
        if (!is_array($data) || !$data)
        {
            return 0;
        }
        if (!is_numeric($id) || !$id)
        {
            return 0;
        }
        $dataCon = $data;
        $dataCon['listorder'] = 0;
        $dataCon['update_time'] = time();
        $dataCon['create_time'] = time();
        $dataCon['status'] = 1;
        $dataCon['count'] = 0;
        $dataCon['username'] = getAdminNameToIndex();
        $res =  $this->_dbc->where('news_id='.$id)->save($dataCon);
        return $res;

    }
    public function updateCount($id,$count)
    {
        $data = array(
            'count' => $count
        );
        $res = $this->_dbc->where('news_id='.$id)->save($data);
        return $res;
    }
    public function getContentByCatId($id)
    {
        if(!is_numeric($id) || !$id)
        {
            return 0;
        }
        $data = array(
            'catid' => $id  ,
            'status' => array('neq',-1),
        );
        $res  = $this->_dbc->where($data)->select();
        return $res;
    }





}
