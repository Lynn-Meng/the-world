<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/Public/css/news/common.css" />
    <link rel="stylesheet" href="/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/Public/js/jquery-3.2.1.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/dialog/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>

<div id="wrapper">

    <?php
 $res = D('Menu')->getAdminMenuList(); $adminName = getAdminNameToIndex(); $index = 'index'; ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">

    <a class="navbar-brand" >CMS内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo ($adminName); ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href=""><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>

        <li class="divider"></li>
        <li>
          <a href="./admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (changeActive($index)); ?>>
        <a href="/admin.php?c=index&a=index"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>

      <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li <?php echo (changeActive($row["c"])); ?>>
          <a href="<?php echo (getAdminUrl($row)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($row["name"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>


    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>


    <div id="page-wrapper">

    <div class="container-fluid" >

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=menu">菜单管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i>菜单内容
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <form action="/admin.php" method="get">

                <div class="input-group">
                    <span class="input-group-addon">类型</span>
                    <select class="form-control" name="type">
                        <option value='-1'<?php if($type == -1): ?>selected="selected"<?php endif; ?>>请选择类型</option>

                        <option value="1" <?php if($type == 1): ?>selected="selected"<?php endif; ?>>后台菜单</option>
                        <option value="0" <?php if($type == 0): ?>selected="selected"<?php endif; ?>>前端导航</option>
                    </select>


                <input type="hidden" name="c" value="menu"/>
                <input type="hidden" name="a" value="index"/>
                <span class="input-group-btn">
                  <button id="sub_data" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                </span>
                </div>
            </form>
        </div>
        <div>
          <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3></h3>
                <div class="table-responsive">
                    <form id="cms-listorder">
                    <table class="table table-bordered table-hover cms-table">
                        <thead>
                        <tr>
                            <th width="14">排序</th>
                            <th>id</th>
                            <th>菜单名</th>
                            <th>模块名</th>
                            <th>类型</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><tr>
                                <td><input size="4" type="text" name="listorder[<?php echo ($menu["menu_id"]); ?>]" value="<?php echo ($menu["listorder"]); ?>"/></td>
                                <td><?php echo ($menu["menu_id"]); ?></td>
                                <td><?php echo ($menu["name"]); ?></td>
                                <td><?php echo ($menu["m"]); ?></td>
                                <td><?php echo (getMenuType($menu["type"])); ?></td>
                                <td><?php echo (status($menu["status"])); ?></td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true" id="cms-edit" attr-id="<?php echo ($menu["menu_id"]); ?>" ></span>    <a href="javascript:void(0)" attr-id="<?php echo ($menu["menu_id"]); ?>" id="cms-delete"  attr-a="menu" attr-message="删除"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>
                    </form>
                    <nav>
                        <div class="container">
                            <ul class="pagination">
                                <!--<li><a href="#"><</a></li>-->
                                <!--<li><a href="#">1</a></li>-->
                                <!--<li><a href="#">2</a></li>-->
                                <!--<li><a href="#">3</a></li>-->
                                <!--<li><a href="#">4</a></li>-->
                                <!--<li><a href="#">5</a></li>-->
                                <!--<li><a href="#">></a></li>-->
                                <!---->
                                <?php
 echo $pageSpi['prev']; for ($i = 0;$i <= count($pageStr) ;$i++) { echo $pageStr[$i]; } echo $pageSpi['next']; ?>

                            </ul>
                        </div>
                    </nav>
                    <div>
                        <button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>更新排序 </button>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->



    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>

    var SCOPE = {

        'add_url' : '/admin.php?c=menu&a=add',
        'delete_url':'/admin.php?c=menu&a=delete',
        'jump_url' : '/admin.php?c=menu',
        'edit_url' : '/admin.php?c=menu&a=edit',
        'listorder_url' : '/admin.php?c=menu&a=listorder',
        'search_url' : '/admin.php?c=menu&a=search'

    };

</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>