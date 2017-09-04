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
        $this->assign('webSiteMenu', $res2);
        $this->assign('sitenavmenuId', $_REQUEST['catid']);
        $this->assign('positions', $positions);
        $this->assign('title', $_REQUEST['title']);
        $this->assign('news', $res);
        $this->display();
    }

    public function search()
    {
        $res = D('News')->getAllNewsContent($_REQUEST);
        $res2 = D('Menu')->getAllCatName();
        $positions = D('Position')->getAllPosition();
        $this->assign('webSiteMenu', $res2);
        $this->assign('sitenavmenuId', $_REQUEST['catid']);
        $this->assign('positions', $positions);
        $this->assign('title', $_REQUEST['title']);
        $this->assign('news', $res);
        $html_content = $this->fetch('content');
        exit($html_content);
    }

    public function delete()
    {
        if ($_REQUEST) {
            $res = D('News')->changeStatusById($_REQUEST);
            if ($res) {
                send(1, '删除成功');
            } else {
                send(0, '删除失败');
            }
        }
    }

    public function listorder()
    {
        if ($_POST) {
            $listorderArray = $_POST['listorder'];
            try {
                foreach ($listorderArray as $key => $value) {
                    $res = D('News')->updateListorder($key, $value);
                }
            } catch (Exception $e) {
                return send(0, $e->getMessage());
            }
            return send(1, '更新成功');

        }
    }

    public function push()
    {
        if ($_POST) {
            try {
                for ($i = 0; $i < count($_POST['newsId']); $i++) {
                    $res = D('News')->getOneRowById($_POST['newsId'][$i]);
                    $positionId = $_POST['positionId'];
                    $addOneRow = D('PositionContent')->addOneRowByCheckboxAndId($res, $positionId);

                }
            } catch (Exception $e) {
                return send(0, $e->getMessage());
            }
            return send(1, '推送成功');
        }
    }

    public function add()
    {
        if ($_POST)
        {
            if (!$_POST['title']) {
                send(0, '标题不能为空');
            }
            if (!$_POST['keywords']) {
                send(0, '关键字不能为空');
            }
            if (!$_POST['content']) {
                send(0, '内容不能为空');
            }
            if (!isset($_POST['thumb']) || !$_POST['thumb']) {
                send(0, '必须上传图片');
            }
            $res = D('News')->addOneRow($_REQUEST);

            if ($res) {
                $newsContentData['content'] = $_POST['content'];
                $newsContentData['news_id'] = $res;
                $cID = D('NewsContent')->insert($newsContentData);
                if ($cID) {
                    return send(1, '添加成功');
                } else {
                    return send(1, '主表插入成功,副表插入失败');
                }
            } else {
                send(0, '添加失败');
            }
        }
            $titleColor = C('TITLE_FONT_COLOR');
            $this->assign('titleFontColor', $titleColor);
            $capyFrom = C('COPY_FROM');
            $this->assign('copyfrom', $capyFrom);
            $res2 = D('Menu')->getAllCatName();
            $this->assign('webSiteMenu', $res2);
            $this->display();

    }
    public function edit()
    {
        if ($_GET)
        {
            $content = D('NewsContent')->getContentById($_GET['common_id']);
            $res = D('News')->getOneRoById($_GET['common_id']);
            $res['content'] = $content['content'];
            $this->assign('news',$res);
            $res2 = D('Menu')->getAllCatName();
            $this->assign('webSiteMenu', $res2);
            $titleColor = C('TITLE_FONT_COLOR');
            $this->assign('titleFontColor', $titleColor);
            $capyFrom = C('COPY_FROM');
            $this->assign('copyfrom', $capyFrom);
        }
        if ($_POST)
        {
            if (!$_POST['title']) {
                send(0, '标题不能为空');
            }
            if (!$_POST['keywords'] ) {
                send(0, '关键字不能为空');
            }
            if (!$_POST['content']) {
                send(0, '内容不能为空');
            }
            if (!isset($_POST['thumb']) || !$_POST['thumb']) {
                send(0, '必须上传图片');
            }
            $id = $_POST['news_id'];
            unset($_POST['news_id']);
            $res = D('News')->EditOneRow($id,$_POST);
            if ($res) {
                $newsContentData['content'] = $_POST['content'];
                $newsContentData['news_id'] = $id;
                $cID = D('NewsContent')->update($id,$newsContentData);
                if ($cID)
                {
                    send(1,'更新成功');
                }
                else
                {
                    send(1, '主表更新成功,副表更新失败');
                }
            } else {
                send(0, '添加失败');
            }
        }


        $this->display();
    }
}