<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body,html{
            width:100%;
            height:100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }
        #all{
            color: #d3d3d3;
            width: 300px;
            height: 300px;
            background-color: #fcfcfc;
            border: 1px solid #ccc;
            text-align: center;
            position: relative;
            border-radius: 5px;
        }
        #all .form-signin h2{
            margin-top: 20px;
            color: #66d9ef;
        }
        #all .sr-only{
            color: #aaa;
        }
        #all .form-control1{
            margin-top: 20px;
            border-radius: 5px;
        }
        #all .form-control2{
            margin-top: 20px;
            border-radius: 5px;
        }
        #all .btn-block{
            margin-top: 50px;
            width:60px;
            height:30px;
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
<div id="all">
    <form class="form-signin" enctype="multipart/form-data"  method="post">
        <h2 class="form-signin-heading">管理员登录</h2>
        <label class="sr-only">用户名</label>
        <input type="text"  class="form-control1" name="username" placeholder="请填写用户名" required autofocus id="inputUsername">
        <br />
        <label  class="sr-only">密&nbsp;&nbsp;&nbsp;码</label>
        <input type="password" name="password" id="inputPassword" class="form-control2" placeholder="密码">
        <br />
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="login.check()">登录</button>
    </form>
</div>
<script src="/Public/js/jquery-3.2.1.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/admin/login.js"></script>

</body>

</html>