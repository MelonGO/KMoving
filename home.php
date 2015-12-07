<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="./bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/mystyle.css" rel="stylesheet">
    <link href="./css/queries.css" rel="stylesheet">
    <link rel="stylesheet" href="/animate.css-master/animate.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="./js/myscript.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".moves").hover(function(){
                $('.moves img').addClass('animated pulse');
            },function(){
                $('.moves img').removeClass('animated pulse');
            });
            $(".workouts").hover(function(){
                $('.workouts img').addClass('animated pulse');
            },function(){
                $('.workouts img').removeClass('animated pulse');
            });
            $(".sleeps").hover(function(){
                $('.sleeps img').addClass('animated pulse');
            },function(){
                $('.sleeps img').removeClass('animated pulse');
            });
            $(".meals").hover(function(){
                $('.meals img').addClass('animated pulse');
            },function(){
                $('.meals img').removeClass('animated pulse');
            });
            $(".mood").hover(function(){
                $('.mood img').addClass('animated pulse');
            },function(){
                $('.mood img').removeClass('animated pulse');
            });
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
        <a class="navbar-brand" href="">KMoving</a>
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

<div class="container-fluid digital-panel">
    <div class="row col-md-10 digital-panel-margin">
        <div class="moves">
            <a href="http://www.kmoving.com/user/info/moves_show.php">
                <img  class="img-responsive img-rounded animated pulse" src="img/moves.jpg"/>
            </a>
        </div>
        <div class="workouts">
            <a href="http://www.kmoving.com/user/info/workouts_show.php">
                <img  class="img-responsive img-rounded" src="img/workouts.jpg"/>
            </a>
        </div>
        <div class="meals">
            <a href="http://www.kmoving.com/user/info/meals_show.php">
                <img  class="img-responsive img-rounded" src="img/meals.jpg"/>
            </a>
        </div>
        <div class="sleeps">
            <a href="http://www.kmoving.com/user/info/sleeps_show.php">
                <img  class="img-responsive img-rounded" src="img/sleeps.jpg"/>
            </a>
        </div>
        <div class="mood">
            <a href="http://www.kmoving.com/user/info/mood_show.php">
                <img  class="img-responsive img-rounded" src="img/mood.jpg"/>
            </a>
        </div>
    </div>
    <div class="row col-md-2">
        <ul class="nav user-info">
            <li>姓名:<?php echo $_GET["name"];?></li>
            <li>性别:<?php echo $_GET["gender"];?></li>
            <li>身高:<?php echo $_GET["height"];?></li>
            <li>体重:<?php echo $_GET["weight"];?></li>
        </ul>
        <a href="http://www.kmoving.com/server/connect_api.php">
            <img  class="img-responsive center-block" id="jawbone-api" src="img/jawbone.jpg"/>
        </a>
    </div>
</div>

</div>

<!--<div class="container bg" style="height: 450px;">-->
<!--    <div class="row">-->
<!--        <div class="col-sm-12 col-md-6 col-lg-6">-->
<!--            <a href="http://www.kmoving.com/server/connect_api.php">-->
<!--                <img  class="img-responsive center-block" id="jawbone-api" src="img/jawbone.jpg"/>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

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