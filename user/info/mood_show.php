<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Mood</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="../../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/mystyle.css" rel="stylesheet">
    <link href="../../css/queries.css" rel="stylesheet">
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

<div class="container-fluid user-info">
    <div class="row">
        <div class="col-md-12">
            <ul class="pager">
                <li class="previous"><a href="http://www.kmoving.com/date_change.php?item=mood&info=previous">&larr; Previous</a></li>
                <li id="date"><?php echo $_COOKIE["date"]?></li>
                <li class="next"><a href="http://www.kmoving.com/date_change.php?item=mood&info=next">Next &rarr;</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li class="active">
                    <a href="http://www.kmoving.com/user/info/moves_show.php">Moves</a>
                </li>
                <li>
                    <a href="http://www.kmoving.com/user/info/workouts_show.php">Workouts</a>
                </li>
                <li>
                    <a href="http://www.kmoving.com/user/info/sleeps_show.php">Sleeps</a>
                </li>
                <li>
                    <a href="http://www.kmoving.com/user/info/mood_show.php">Mood</a>
                </li>
                <li>
                    <a href="http://www.kmoving.com/user/info/meals_show.php">Meals</a>
                </li>
            </ol>
            <?php
            include("../../server/user/mood.php");
            ?>
        </div>
    </div>
</div>

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