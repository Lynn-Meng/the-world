<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/9/4
 * Time: 下午4:51
 */
namespace Home\Controller;
use Think\Controller;

class DetailController extends Controller
{
    public function index()
    {
        if ($_GET)
        {
            $news_id = $_GET['id'];
            //获取新闻标题
            $title = D('News')->getOneRoById($news_id);
            //获取新闻详情
            $content = D('NewsContent')->getContentById($news_id);
            $result = array(
                'title' => $title['title'],
                'content' => htmlspecialchars_decode($content['content'])
            );
            $nav = D('Menu')->getAllCatName();
            $this->assign('navs',$nav);
            $news = D('News')->getNewsListByCount();
            $hotNews = D('PositionContent')->getHotNews();
            $this->assign('resultNews',$news);
            $this->assign('resultHotPic',$hotNews);
            $this->assign('volist',$result);

        }
        $this->display();

    }
}