<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Advice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/mystyle.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="../js/myscript.js"></script>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://www.kmoving.com/server/user/user_details.php">KMoving</a>
    </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="http://www.kmoving.com/server/user/user_details.php">数字面板</a>
            </li>
            <li>
                <a href="http://www.kmoving.com/user/analysis.php">统计</a>
            </li>
            <li>
                <a href="http://www.kmoving.com/user/advice.php">建议</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    社区
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="http://www.kmoving.com/user/groups/activity.php">活动</a></li>
                </ul>
            </li>
        </ul>
        <div>
            <ul class="nav navbar-nav navbar-right navbar-right-padding">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-2x"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="http://www.kmoving.com/server/user/settings.php">设置</a></li>
                        <li><a href="http://www.kmoving.com">登出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container bg">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h1 class="font-big font-white">
                建议</br>
                <small>健康建议</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="http://www.kmoving.com/user/advice.php">我的建议</a></li>
                <li class="active"><a href="http://www.kmoving.com/user/advice_create.php">其他用户</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>用户列表</h2>
            <?php
            include("../server/advice/user_list.php");
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="advice" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    提出建议
                </h4>
            </div>
            <form class="form-horizontal" role="form" action="http://www.kmoving.com/server/advice/advice_create.php"
                  method="post" onsubmit="return(advice_create())">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="toUserId" class="col-sm-2 control-label">用户ID:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="toUserId" name="toUserId" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">建议标题:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title"
                                   placeholder="请输入建议标题" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">建议内容:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="content"
                                      placeholder="请输入建议内容" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal" onclick="clear_all()">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary" onsubmit="">
                        确认
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function get_toUserId(toUserId){
        var user_id = document.getElementById("toUserId");
        user_id.value = toUserId;
    }

    function advice_create(){
        var msg="";
        if($("#title").val().length == 0)
        {
            msg="请输入建议标题!";
            alert(msg);
            return false;
        }
        if($("#content").val().length == 0) {
            msg = "请输入建议内容!";
            alert(msg);
            return false;
        }
    }

    function clear_all(){
        document.getElementById("title").value = "";
        document.getElementById("content").value = "";
    }
</script>

<?php
$msg = $_GET['msg'];
if($msg=="NotDoc"){
    echo "<script type='text/javascript'>alert('对不起，你不不是医生/教练!');</script>";
}
?>

<script>$(function ()
    { $("[data-toggle='popover']").popover();
    });
</script>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="legals">
                    <li><a href="#">More Information</a></li>
                    <li><a href="#">MelonGO</a></li>
                </ul>
            </div>
            <div class="col-md-6 credit">
                <p>&copy;Copyright 2015 - melon</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>