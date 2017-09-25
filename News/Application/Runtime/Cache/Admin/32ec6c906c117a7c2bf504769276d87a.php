<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Login Example - Semantic</title>
  <link rel="stylesheet" type="text/css" href="components/reset.css">
  <link rel="stylesheet" type="text/css" href="components/site.css">

  <link rel="stylesheet" type="text/css" href="components/container.css">
  <link rel="stylesheet" type="text/css" href="components/grid.css">
  <link rel="stylesheet" type="text/css" href="components/header.css">
  <link rel="stylesheet" type="text/css" href="components/image.css">
  <link rel="stylesheet" type="text/css" href="components/menu.css">

  <link rel="stylesheet" type="text/css" href="components/divider.css">
  <link rel="stylesheet" type="text/css" href="components/segment.css">
  <link rel="stylesheet" type="text/css" href="components/form.css">
  <link rel="stylesheet" type="text/css" href="components/input.css">
  <link rel="stylesheet" type="text/css" href="components/button.css">
  <link rel="stylesheet" type="text/css" href="components/list.css">
  <link rel="stylesheet" type="text/css" href="components/message.css">
  <!--<link rel="stylesheet" type="text/css" href="components/.css">-->

  <script src="assets/library/jquery.min.js"></script>
  <script src="components/form.js"></script>
  <script src="components/transition.js"></script>

  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <img src="assets/images/logo.png" class="image">
      <div class="content">
        Log-in to your account
      </div>
    </h2>
    <form class="ui large form">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left  input">
            <i class="user "></i>
            <input type="text" name="email" placeholder="Username" id="inputUsername" >
          </div>
        </div>
        <div class="field">
          <div class="ui left  input">
            <i class="lock "></i>
            <input type="password" name="password" placeholder="Password" id="inputPassword">
          </div>
        </div>
        <div class="ui fluid large teal submit button" onclick="login.check()">Login</div>
      </div>

      <div class="ui error message"></div>

    </form>


  </div>
</div>
<script src="/Public/js/jquery-3.2.1.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/admin/login.js"></script>
</body>

</html>