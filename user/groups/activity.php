<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Activity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="../../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/mystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="/animate.css-master/animate.min.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="../../js/myscript.js"></script>

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
                    <li><a href="">活动</a></li>
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
                活动</br>
                <small>参加活动</small>
            </h1>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <form class="navbar-form" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search Activity">
                </div>
                <button type="submit" class="btn btn-info fa fa-search"></button>
            </form>
        </div>
    </div>
    <div>
        <button class="btn btn-toolbar btn-block fa fa-plus fa-3x" data-toggle="modal" data-target="#myModal"></button>
    </div>
    <hr class="division">
    <div>
        <button class="btn btn-default btn-block fa fa-eraser fa-3x" data-toggle="modal" data-target="#refresh"></button>
    </div>
    <?php
    include("../../server/groups/activity_data.php");
    ?>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    新建活动
                </h4>
            </div>
            <form class="form-horizontal" role="form" action="http://www.kmoving.com/server/groups/activity_create.php"
                  method="post" onsubmit="return(activity_create())">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">活动标题:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title"
                                   placeholder="请输入标题" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="target" class="col-sm-2 control-label">活动目标:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="target"
                                   placeholder="请输入目标" name="target">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">活动内容:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="content"
                                      placeholder="请输入内容" name="content"></textarea>
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

<div class="modal fade" id="refresh" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    修改活动
                </h4>
            </div>
            <form class="form-horizontal" role="form" action="http://www.kmoving.com/server/groups/activity_refresh.php"
                  method="post" onsubmit="return(activity_refresh())">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id-refresh" class="col-sm-2 control-label">活动ID:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="id-refresh"
                                   placeholder="请输入要修改的活动ID" name="id-refresh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title-refresh" class="col-sm-2 control-label">活动标题:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title-refresh"
                                   placeholder="请输入修改后的标题" name="title-refresh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="target-refresh" class="col-sm-2 control-label">活动目标:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="target-refresh"
                                   placeholder="请输入修改后的目标" name="target-refresh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content-refresh" class="col-sm-2 control-label">活动内容:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="content-refresh"
                                      placeholder="请输入修改后的内容" name="content-refresh"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal" onclick="clear_all_refresh()">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary" onsubmit="">
                        修改
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add-member" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    加入活动
                </h4>
            </div>
            <form class="form-horizontal" role="form" action="http://www.kmoving.com/server/groups/activity_add_member.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="activityId" class="col-sm-2 control-label">活动ID:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="activityId" name="activityId" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <h1 class="pull-right">是否要加入该活动？</h1>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary add-activity" >
                        加入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function get_activityId(activityId){
        var activity_id = document.getElementById("activityId");
        activity_id.value = activityId;
    }

    function clear_all(){
        document.getElementById("title").value = "";
        document.getElementById("target").value = "";
        document.getElementById("content").value = "";
    }

    function clear_all_refresh(){
        document.getElementById("id-refresh").value = "";
        document.getElementById("title-refresh").value = "";
        document.getElementById("target-refresh").value = "";
        document.getElementById("content-refresh").value = "";
    }

    function click_delete(ID){
        window.location.href = "../../server/groups/activity_delete.php?delete_id="+ID;
    }

    function click_refresh(ID){
        window.location.href = "../../server/groups/activity_refresh.php?refresh_id="+ID;
    }
</script>

<script>
    function activity_create(){
        var msg="";
        if($("#title").val().length == 0)
        {
            msg="请输入活动标题!";
            alert(msg);
            return false;
        }
        if($("#target").val().length == 0)
        {
            msg="请输入活动目标!";
            alert(msg);
            return false;
        }
        if($("#content").val().length == 0) {
            msg = "请输入活动内容!";
            alert(msg);
            return false;
        }
    }

    function activity_refresh(){
        var msg="";
        if($("#id").val().length == 0)
        {
            msg="请输入活动ID!";
            alert(msg);
            return false;
        }
        if($("#title-refresh").val().length == 0)
        {
            msg="请输入活动标题!";
            alert(msg);
            return false;
        }
        if($("#target-refresh").val().length == 0)
        {
            msg="请输入活动目标!";
            alert(msg);
            return false;
        }
        if($("#content-refresh").val().length == 0) {
            msg = "请输入活动内容!";
            alert(msg);
            return false;
        }
    }
</script>

<?php
$msg = $_GET['msg'];
if($msg=="noAuthority"){
    echo "<script type='text/javascript'>alert('对不起，你没有删除或修改该活动的权限!');</script>";
}
if($msg=="memberExist"){
    echo "<script type='text/javascript'>alert('加入失败，你已加入该活动!');</script>";
}
?>

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