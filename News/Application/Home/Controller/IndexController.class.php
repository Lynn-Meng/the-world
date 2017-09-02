<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $pics = D('News')->getThreePic();
        $nav = D('Menu')->getAllCatName();
        $this->assign("result['topSmailNews']",$pics);
        $this->assign('navs',$nav);
        $this->display();
    }

}