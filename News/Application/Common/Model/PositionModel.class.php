<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/23
 * Time: 下午3:16
 */
namespace Common\Model;
use Think\Model;

class PositionModel extends Model
{

    private $_dbc = '';
    function __construct()
    {
        parent::__construct();
        $this->_dbc = M('position');
    }
    public function getAllPosition()
    {
        $dataCon  = array(
            'status' => 1,
        );
        $res = $this->_dbc->where($dataCon)->select();
        return $res;
    }
    public function insert($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $data['create_time'] = time();
        $res = $this->_dbc->add($data);
        return $res;
    }
    public function delete($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $dataCon = array(
            'status' => $data['status'],
        );
        $res = $this->_dbc->where("id=".$data['common_id'])->save($dataCon);
        return $res;
    }
    public function edit($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $res = $this->_dbc->where("id=".$data['common_id'])->find();
        return $res;
    }
    public function update($id,$data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        if (!is_numeric($id))
        {
            return 0;
        }
        $res = $this->_dbc->where("id=".$id)->save($data);
        return $res;
    }



}