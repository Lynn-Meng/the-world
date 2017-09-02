<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/8/21
 * Time: 下午7:42
 */
function send($status,$msg,$data)
{
    $result = array(
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    );
    exit(json_encode($result));
}

function getAdminNameToIndex()
{
    $adminName = isset($_SESSION['adminMsg']['username']) ? $_SESSION['adminMsg']['username'] : '';
    return $adminName;
}
function getAdminUrl($row)
{
    $res = '/admin.php?c='.$row['c'].'&a='.$row['f'];
    return $res;
}

function changeActive($conName)
{
    $c = strtolower(CONTROLLER_NAME);
    if ($c == strtolower($conName))
    {
        return 'class="active"';
    }
}
function getMenuType($type)
{
    if ($type == 1)
    {
        return '后台模块';
    }
    else
    {
        return '前台模块';
    }
}
function status($status)
{
    if ($status == 1)
    {
        return '正常';
    }
    else
    {
        return '关闭';
    }
}
function isThumb($data)
{
    if ($data)
    {
        echo "<span style='color: red;'>有</span>";
    }
    else
    {
        echo "<span style='color: black;'>无</span>";

    }
}
function getCatName($catid)
{
    $res = D('Menu')->getCatNameById($catid);
    return $res['name'];
}
function getCopyFromById($data)
{
    $res = C('COPY_FROM')[$data];
    return $res;
}



