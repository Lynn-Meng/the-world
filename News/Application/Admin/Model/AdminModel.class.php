<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午8:10
 */
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model
{
    private $_dbc = '';
    function __construct()
    {
        $this->_dbc = M('admin');
    }
    public function getAdminName($username)
    {
        $res = $this->_dbc->where("username = '$username'")->find();
        return $res;
    }
    public function getAllAdmin($pageNum,$pageSize)
    {

        if (!is_numeric($pageNum) || !is_numeric($pageSize))
        {
            return 0;
        }
        $offset = ($pageNum - 1) * $pageSize;

        $data['status'] = 1;
        $res = $this->_dbc->where($data)->limit($offset,$pageSize)->select();
        return $res;
    }
    public function insert($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $data['lastloginip'] = 0;
        $data['lastloginip'] = 0;
        $data['status'] = 1;
        $data['password'] = md5($data['password']);
        $res = $this->_dbc->add($data);
        return $res;
    }
    public function delete($data)
    {
        if (!$data || !is_array($data))
        {
            return 0;
        }
        $dataCon['status'] = $data['status'];
        $res = $this->_dbc->where('admin_id='.$data['common_id'])->save($dataCon);
        return $res;
    }
    public function getAdminCount()
    {

        $dataCon['status'] = 1;
        $res = $this->_dbc->where($dataCon)->count();
        return $res;
    }
}