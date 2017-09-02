<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午8:30
 */
namespace Common\Model;

use Think\Model;

class MenuModel extends Model
{
    private $_dbc = '';
    public function __construct()
    {
        parent::__construct();
        $this->_dbc = M('menu');
    }
    public function getAdminMenuList()
    {
        $condition = array(
            'status' => array('neq' ,-1),
            'type' => 1
        );
        return $this->_dbc->where($condition)->order('listorder desc, menu_id desc')->select();
    }
    public function getMenuContent($condition,$pageNum = 0,$pageSize = 3)
    {
        if (!is_array($condition))
        {
            return 0;
        }
        if (!is_numeric($pageNum) || !is_numeric($pageSize))
        {
            return 0;
        }
        if (in_array(intval($condition['type']),array(0,1)) && $condition != null)
        {
            $dataCon['type'] = intval($condition['type']);
        }
        $dataCon['status'] = array('neq',-1);
        $offset = ($pageNum - 1) * $pageSize;
        $res = $this->_dbc->where($dataCon)->order('listorder desc,menu_id desc')->limit($offset,$pageSize)->select();
        return $res;
    }
    public function getMenuCount($data)
    {
        if (!is_array($data))
        {
            return 0;
        }
        if (in_array(intval($data['type']),array(0,1))  &&  $data != null)
        {
            $dataCon['type'] = intval($data['type']);
        }
        $dataCon['status'] = array('neq',-1);
        $res = $this->_dbc->where($dataCon)->count();
        return $res;
    }

    //添加数据方法
    public function insert($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $res = $this->_dbc->add($data);
        return $res;
    }
    public function update($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $dataCon = array(
            'status' => $data['status'],
        );
        $res = $this->_dbc->where("menu_id=".$data['common_id'])->save($dataCon);
        return $res;

    }
    //根据id获取一行信息
    public function getOneRowById($menu_id)
    {
        if (!is_numeric($menu_id))
        {
            return 0;
        }
        $res = $this->_dbc->where('menu_id='.$menu_id)->find();
        return $res;
    }
    public function updateMenuById($menu_id,$data)
    {
        if (!is_numeric($menu_id) || !is_array($data))
        {
            return 0;
        }
        $res = $this->_dbc->where('menu_id='.$menu_id)->save($data);
        return $res;
    }
    public function updateListorderById($menu_id,$newListorder)
    {
        if (!is_numeric($menu_id) || !is_numeric($newListorder))
        {
            return 0;
        }
        $data = array(
            'listorder' => $newListorder
        );
        $res = $this->_dbc->where('menu_id='.$menu_id)->save($data);
        return $res;

    }
    public function getCatNameById($data)
    {
        if (!$data)
        {
            return 0;
        }
        $res = $this->_dbc->where('menu_id='.$data)->find();
        return $res;
    }
    public function getAllCatName()
    {
        $data = array(
            'status' => '1',
            'type' => '0'
        );
        $res = $this->_dbc->where($data)->select();
        return $res;
    }

}