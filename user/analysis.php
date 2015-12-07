<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Analysis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/mystyle.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="../js/myscript.js"></script>

    <link rel="stylesheet" href="../animate.css-master/animate.min.css">
    <script type="text/javascript">
        $(document).ready(function(){
            $(".rect").addClass('animated slideInDown');
        });
    </script>
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
        <div class="col-md-12">
            <h1 class="font-big font-white">
                统计</br>
                <small>数据分析</small>
            </h1>
        </div>
        <?php
        include "../server/analysis/analysis.php";
        ?>
    </div>
</div>

<script type="text/javascript">

    var c=document.getElementById("myCanvas");
    var cxt=c.getContext("2d");
    cxt.moveTo(10,10);
    cxt.lineTo(150,50);
    cxt.lineTo(10,50);
    cxt.stroke();

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