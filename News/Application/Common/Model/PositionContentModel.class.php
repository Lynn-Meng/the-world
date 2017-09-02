<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/23
 * Time: 下午5:02
 */
namespace Common\Model;
use Think\Model;

class PositionContentModel extends Model
{
    private $_dbc = '';
    function __construct()
    {
        parent::__construct();
        $this->_dbc = M('position_content');
    }
    public function getAllContent($data = array())
    {
        $condition = $data;
        if (isset($data['title']) && $data['title'])
        {
            $condition['title'] = array('like','%'.$data['title'].'%');
        }
        $condition['status'] = array('neq',-1);
        $res = $this->_dbc->where($condition)->order('listorder desc, id desc')->select();
        return $res;
    }
    public function getPositionContentById($id)
    {
        if (!is_numeric($id))
        {
            return 0;
        }
        return $this->_dbc->where('id='.$id)->find();
    }
    public function changeStatusById($data)
    {
        if (!is_array($data) || !$data)
        {
            return 0;
        }
        $dataCon['status'] = $data['status'];
        $res = $this->_dbc->where('id='.$data['common_id'])->save($dataCon);
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
        $res = $this->_dbc->where('id='.$menu_id)->save($data);
        return $res;
    }
    public function addOneRowByCheckboxAndId($data,$positionId)
    {
//        if (!$data)
//        {
//            return 0;
//        }
//        if (!is_numeric($positionId) || !$positionId)
//        {
//            return 0;
//        }
        $dataCon = $data;
        $dataCon['position_id'] = $positionId;
        $dataCon['listorder'] = 0;
        $dataCon['status'] = 1;
        $res = $this->_dbc->add($dataCon);
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
    public function updateById($id,$data)
    {
        if (!is_array($data) || !$data)
        {
            return 0;
        }
        if (!is_numeric($id))
        {
            return 0;
        }
        $res = $this->_dbc->where('id='.$id)->save($data);
        return $res;
    }
}