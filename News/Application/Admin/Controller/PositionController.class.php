<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午8:51
 */
namespace Admin\Controller;
use Think\Controller;

class PositionController extends Controller
{
    public function index()
    {
        $res = D('Position')->getAllPosition();
        $this->assign('positions',$res);
        $this->display();

    }
    public function add()
    {
        if ($_POST)
        {
            if ($_POST['name'])
            {
                if ($_POST['description'])
                {
                    if($_POST['status'])
                    {
                        $res = D('Position')->insert($_POST);
                        if ($res)
                        {
                            send(1,'添加成功');
                        }
                        else
                        {
                            send(0,'添加失败');
                        }
                    }
                    else
                    {
                        send(0,'状态不能为空');
                    }
                }
                else
                {
                    send(0,'推荐位描述不能为空');
                }
            }
            else
            {
                send(0,'推荐位名称不能为空');
            }
        }
        $this->display();
    }
    public function delete()
    {
        if ($_POST)
        {
            $res = D('Position')->delete($_POST);
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
    public function edit()
    {
        if ($_GET)
        {
            $res = D('Position')->edit($_GET);
            $this->assign('vo',$res);
            $this->display();
        }
    }
    public function update()
    {
        if ($_POST)
        {
            $id = $_POST['id'];
            unset($_POST['id']);
            if ($_POST['name'])
            {
                if ($_POST['description'])
                {
                    $res = D('Position')->update($id,$_POST);
                    if ($res)
                    {
                        send(1,'更新成功');
                    }
                    else
                    {
                        send(0,'更新失败');
                    }
                }
                else
                {
                    send(0,'推荐位描述不能为空');
                }
            }
            else
            {
                send(0,'推荐为名称不能为空');
            }
        }
    }
}