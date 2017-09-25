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
            if ($news_id <= 0 || !$news_id)
            {
                $this->error('id不合法!');
            }
            //获取新闻标题
            $title = D('News')->getOneRoById($news_id);
            $newCount = $title['count'] + 1;
            $updateCount = D('News')->updateCount($news_id,$newCount);
            if (!$updateCount)
            {
                $this->error('未知错误');
            }
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