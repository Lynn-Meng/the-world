<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $pics = D('PositionContent')->getThreePic();
        $nav = D('Menu')->getAllCatName();
        $news = D('News')->getNewsListByCount();
        $hotNews = D('PositionContent')->getHotNews();
        $count = D('News')->getOneRoById($pics[0]['news_id']);
        $this->assign('resultNews',$news);
        $this->assign("resultPic",$pics);
        $this->assign('navs',$nav);
        $this->assign('resultHotPic',$hotNews);
        $this->assign('count',$count['count']);
        $this->display();
    }
    public function error($message)
    {
        $message = $message ? $message : '系统发生错误';
        $this->assign('message',$message);
        $this->display('Index/error');
    }

}