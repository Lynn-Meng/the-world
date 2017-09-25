<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午8:50
 */
namespace Admin\Controller;
use Think\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $data = array();
        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1)))
        {
            $data['type'] = intval($_REQUEST['type']);
            $this->assign('type',$data['type']);
        }
        else
        {
            $this->assign('type',-1);
        }

        $pageNum = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $pageSize = 3;
        $res = D('Menu')->getMenuContent($data,$pageNum,$pageSize);
        $menuCount = D('Menu')->getMenuCount($data);
        $pageObj = new \Think\Page($menuCount,$pageSize);
        $pageString = $pageObj->show();
        $this->assign('pageStr',$pageString);
        $this->assign('menus',$res);

//        dump($res);
        $this->display();
    }
    //    public function search()
//    {
//        $data = array();
//        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1)))
//        {
//            $data['type'] = intval($_REQUEST['type']);
//            $this->assign('type',$data['type']);
//        }
//        else
//        {
//            $this->assign('type',-1);
//        }
//        $pageSize = 3;
//        $pageNum = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
//        $res = D('Menu')->getMenuContent($data,$pageNum,$pageSize);
//        $this->assign('menus',$res);
//
////        $pageObj = new \Think\Page($menuCount,$pageSize);
////        $pageString = $pageObj->show();
////        $this->assign('pageStr',$pageString);
//
//
//
//
//        $menuCount = D('Menu')->getMenuCount($data);
//        $pageNumber = ceil($menuCount/$pageSize);
//        $pageStr = array();
//        for($i = 1;$i <= $pageNumber ; $i++)
//        {
//            $pageli = "<li id=pageId$i data-id=$i><a href=\"#\"  onclick='searchByNum($i)'>$i</a></li>";
//            array_push($pageStr,$pageli);
//        }
//
//        //上一页与下一页
//        if ($pageNum != $pageNumber) {
//            $pageSpi['next'] = "<li><a href=\"#\" onclick='searchByNext()' >></a></li>";
//        }
//        if ($pageNum != 1)
//        {
//            $pageSpi['prev'] = "<li><a href=\"#\" onclick='searchByPrev()' ><</a></li>";
//        }
//
//        $this->assign('pageStr',$pageStr);
//        $this->assign('pageSpi',$pageSpi);
//
//        $html_go = $this->fetch('content');
//        exit($html_go);
//
//
//    }
    public function add()
    {
        if ($_POST)
        {
            if (!$_POST['name'] || !isset($_POST['name']))
            {
                return send(0,'菜单名不能为空');
            }
            if (!isset($_POST['type']))
            {
                return send(0,'菜单类型不能为空');
            }
            if (!$_POST['m'] || !isset($_POST['m']))
            {
                return send(0,'模块名不能为空');
            }
            if (!$_POST['c'] || !isset($_POST['c']))
            {
                return send(0,'控制器不能为空');
            }
            if (!$_POST['f'] || !isset($_POST['f']))
            {
                return send(0,'方法名不能为空');
            }
            if (!$_POST['status'] || !isset($_POST['status']))
            {
                return send(0,'状态值不能为空');
            }
            //存入数据库
            $res = D('Menu')->insert($_POST);
            if ($res)
            {
                return send(1,'添加成功');
            }
            else
            {
                return send(0,'添加失败');
            }

        }

        $this->display();
    }
    public function delete()
    {
        if ($_POST)
        {
            $res = D('Menu')->update($_POST);

            if ($res)
            {
                return send(1,'删除成功');
            }
            else
            {
                return send(0,'删除失败');
            }
        }
    }
    public function edit()
    {
        if ($_GET)
        {
            $menu_id = $_GET['common_id'];
            //根据id查询这个菜单信息
            $res = D('Menu')->getOneRowById($menu_id);
            $this->assign('menu',$res);
            $this->display();
        }
    }
    public function update()
    {
        if ($_POST)
        {
            $menu_id = $_POST['menu_id'];
            unset($_POST['menu_id']);
            $res = D('menu')->updateMenuById($menu_id,$_POST);
            if ($res)
            {
                return send(1,'更新成功');
            }
            else
            {
                return send(0,'更新失败');
            }
        }
    }
    public function listorder()
    {
        if ($_POST)
        {
            $listorderArray = $_POST['listorder'];
            try
            {
                foreach ($listorderArray as $key => $value)
                {
                    $res = D('Menu')->updateListorderById(intval($key),intval($value));
                }
            }
            catch (Exception $e)
            {
                return send(0,$e->getMessage());
            }

        }
    }

}