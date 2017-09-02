<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午8:51
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class PositionContentController extends Controller
{
    public function index()
    {
        $data = array();
        if (isset($_REQUEST['title']) && $_REQUEST['title'])
        {
            $data['title'] = $_REQUEST['title'];
        }
        $position_id = isset($_REQUEST['position_id']) ? $_REQUEST['position_id'] : 2;
        $data['position_id'] = $position_id;


        $positions = D('Position')->getAllPosition();
        $res = D('PositionContent')->getAllContent($data);
        $this->assign('title',$_REQUEST['title']);
        $this->assign('positionId',$position_id);
        $this->assign('positions',$positions);
        $this->assign('contents',$res);
        $this->display();
    }
    public function add()
    {
        if($_POST)
        {
            if (!$_POST['title'])
            {
                send(0,'标题不能为空');
            }
            if (!$_POST['position_id'])
            {
                send(0,'推荐位不能为空');
            }
            if (!isset($_POST['thumb']) || !$_POST['thumb'])
            {
                send(0,'必须上传图片');
            }
            $res = D('PositionContent')->insert($_POST);
            if ($res)
            {
                send(1,'添加成功');
            }
            else
            {
                send(0,'添加失败');
            }
        }
        $positions = D('Position')->getAllPosition();
        $this->assign('positions',$positions);
        $this->display();
    }
    public function edit()
    {
        if ($_GET)
        {
            $id = $_GET['common_id'];
            $res = D('PositionContent')->getPositionContentById($id);
            $this->assign('vo',$res);
        }
        $this->display();
    }
    public function delete()
    {
        if ($_REQUEST)
        {
            $res = D('PositionContent')->changeStatusById($_REQUEST);
            if ($res)
            {
                send(1,'删除成功');
            }
            else
            {
                send(0,'删除失败');
            }
        }
    }
    public function listorder()
    {
        if($_POST)
        {
            $array = $_POST['listorder'];
            try
            {
                foreach ($array as $key => $value)
                {
                    $res = D('PositionContent')->updateListorderById(intval($key),intval($value));
                }
            }
            catch (Exception $e)
            {
                return send(0,$e->getMessage());
            }
            return send(1,'更新排序成功');
        }
    }
    public function update()
    {
        if ($_POST)
        {
            $id = $_POST['id'];
            unset($_POST['id']);
            $res = D('PositionContent')->updateById($id,$_POST);
            if ($res)
            {
                send(1,'更新成功');
            }
            else
            {
                send(0,'更新失败');
            }
        }
    }


}