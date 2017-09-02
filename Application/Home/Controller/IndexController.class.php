<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $pics = D('News')->getThreePic();
        $nav = D('Menu')->getAllCatName();
        $news = D('News')->getAllNewsContent();
        $hotNews = D('PositionContent')->getHotNews();
        $this->assign('resultNews',$news);
        $this->assign("resultPic",$pics);
        $this->assign('navs',$nav);
        $this->assign('resultHotPic',$hotNews);

        $this->display();
    }
}