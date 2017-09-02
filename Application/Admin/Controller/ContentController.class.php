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

class ContentController extends Controller
{


    public function index()
    {
        $res = D('News')->getAllNewsContent($_REQUEST);
        $res2 = D('Menu')->getAllCatName();
        $positions = D('Position')->getAllPosition();
        $this->assign('webSiteMenu',$res2);
        $this->assign('sitenavmenuId',$_REQUEST['catid']);
        $this->assign('positions',$positions);
        $this->assign('title',$_REQUEST['title']);
        $this->assign('news',$res);
        $this->display();
    }
    public function search()
    {
        $res = D('News')->getAllNewsContent($_REQUEST);
        $res2 = D('Menu')->getAllCatName();
        $positions = D('Position')->getAllPosition();
        $this->assign('webSiteMenu',$res2);
        $this->assign('sitenavmenuId',$_REQUEST['catid']);
        $this->assign('positions',$positions);
        $this->assign('title',$_REQUEST['title']);
        $this->assign('news',$res);
        $html_content = $this->fetch('content');
        exit($html_content);
    }
    public function delete()
    {
        if ($_REQUEST)
        {
            $res = D('News')->changeStatusById($_REQUEST);
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
        if ($_POST)
        {
            $listorderArray = $_POST['listorder'];
            try{
                foreach ($listorderArray as $key => $value)
                {
                    $res = D('News')->updateListorder($key,$value);
                }
            }
            catch (Exception $e)
            {
                return send(0,$e->getMessage());
            }
            return send(1,'更新成功');

        }
    }
    public function push()
    {
        if ($_POST)
        {
            try
            {
                for ($i = 0;$i < count($_POST['newsId']);$i++)
                {
                    $res = D('News')->getOneRowById($_POST['newsId'][$i]);
                    $positionId = $_POST['positionId'];
                    $addOneRow = D('PositionContent')->addOneRowByCheckboxAndId($res,$positionId);

                }
            }
            catch (Exception $e)
            {
                return send(0,$e->getMessage());
            }
            return send(1,'推送成功');
        }
    }
    public function add()
    {
        if($_POST)
        {
            if (!$_POST['title'])
            {
                send(0,'标题不能为空');
            }
            if (!isset($_POST['thumb']) || !$_POST['thumb'])
            {
                send(0,'必须上传图片');
            }
            $res = D('News')->insert($_POST);

            if ($res)
            {
                send(1,'添加成功');
            }
            else
            {
                send(0,'添加失败');
            }
        }
        $capyFrom = C('COPY_FROM');
        $this->assign('copyfrom',$capyFrom);
        $res2 = D('Menu')->getAllCatName();
        $this->assign('webSiteMenu',$res2);
        $this->display();
    }



}