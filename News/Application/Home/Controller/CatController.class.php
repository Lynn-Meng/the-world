<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/9/5
 * Time: 上午9:23
 */
namespace Home\Controller;
use Think\Controller;

class CatController extends Controller
{
    public function index()
    {
        $catId = $_GET['id'];
        //根据catId 获取对应栏目所有新闻
        if($catId <= 0 || !$catId)
        {
            $this->error('id不合法');
        }
        $nav = D('Menu')->getAllCatName();
        $this->assign('navs',$nav);
        $news = D('News')->getNewsListByCount();
        $hotNews = D('PositionContent')->getHotNews();
        $this->assign('resultNews',$news);
        $this->assign('resultHotPic',$hotNews);
        $res = D('News')->getContentByCatId($catId);
        $result = array(
            'listNews' => $res,
            'catId' => $catId
        );
        $this->assign('result',$result);
        $this->display();
    }
    public function error($message)
    {
        $message = $message ? $message : '系统发生错误';
        $this->assign('message',$message);
        $this->display('Index/error');
    }
}