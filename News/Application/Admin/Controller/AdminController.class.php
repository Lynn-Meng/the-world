<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午8:48
 */
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $pageNum = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $pageSize = 3;
        $res = D('Admin')->getAllAdmin($pageNum,$pageSize);
        $count = D('Admin')->getAdminCount();

        $pageObj = new \Think\Page($count,$pageSize);
        $pageString = $pageObj->show();
        $this->assign('admins',$res);
        $this->assign('pageStr',$pageString);
        $this->display();
    }
    public function add()
    {
        if ($_POST)
        {
            if ($_POST['username'])
            {
                if ($_POST['password'])
                {
                    if ($_POST['realname'])
                    {
                        $res = D('Admin')->insert($_POST);
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
                        send(0,'真实姓名不能为空');
                    }
                }
                else
                {
                    send(0,'密码不能为空');
                }
            }
            else
            {
                send(0,'用户名不能为空');
            }
        }
        $this->display();
    }
    public function delete()
    {
        if ($_POST)
        {
             $res = D('Admin')->delete($_POST);
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
}