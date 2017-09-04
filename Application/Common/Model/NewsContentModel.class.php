<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/9/4
 * Time: 上午9:41
 */
namespace Common\Model;

use Think\Model;

class NewsContentModel extends Model
{
    private $_dbc = '';
    public function __construct()
    {
        parent::__construct();
        $this->_dbc = M('news_content');
    }
    public function insert($data = array())
    {
        if (!is_array($data) || !$data)
        {
            return 0;
        }
        $data['create_time'] = time();
        if (isset($data['content']) && $data['content'])
        {
            $data['content'] = htmlspecialchars($data['content']);
        }
        return $this->_dbc->add($data);
    }
    public function getContentById($id)
    {
        if (!is_numeric($id) || !$id)
        {
            return 0;
        }
        return $this->_dbc->where('news_id='.$id)->find();
    }
    public function update($id,$data)
    {
        $res = $this->_dbc->where('news_id='.$id)->save($data);
        return $res;
    }

}