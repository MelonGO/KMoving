<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/mystyle.css" rel="stylesheet">
    <link href="../css/queries.css" rel="stylesheet">
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
        <a class="navbar-brand" href="http://www.kmoving.com">KMoving</a>
    </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="http://www.kmoving.com/user/login.php">数字面板</a></li>
            <li><a href="http://www.kmoving.com/user/login.php">统计</a></li>
            <li>
                <a href="http://www.kmoving.com/user/login.php">建议</a>
            </li>
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                    社区 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="http://www.kmoving.com/user/login.php">活动</a></li>
                </ul>
            </li>
        </ul>
        <div>
            <ul class="nav navbar-nav navbar-right navbar-right-padding">
                <li class="active"><a href="http://www.kmoving.com/user/login.php">登陆</a></li>
                <li><a href="">注册</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="middle-register img-responsive">
                <div class="loginpanel">
                    <i id="loading" class="hidden fa fa-spinner fa-spin bigicon"></i>
                    <h1 class="login">
                        <span class="fa fa-quote-left "></span> 注册 <span class="fa fa-quote-right "></span>
                    </h1>
                    <div>
                        <form action="http://www.kmoving.com/server/register_server.php" method="post" onsubmit="return(loginbtn_click())">
                            <input class="login" id="username" type="text" onfocus="clearErrorRegister()" placeholder="注册账号" name="username">
                            <input class="login" id="password" type="password" onfocus="clearErrorRegister()" placeholder="输入密码" name="password">
                            <label class="checkbox">
                                <input type="checkbox" name="checkbox">我是医生/教练
                            </label>
                            <p id="register-error" style="font-size: 1em">
                                <?php
                                if($_GET["Error"] != null && $_GET["Error"] == "userExist"){
                                    echo "该账号已存在!";
                                }
                                ?>
                            </p>
                            <div class="buttonwrapper">
                                <button id="loginbtn" class="btn btn-success loginbutton">
                                    <span class="fa fa-check"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function loginbtn_click(){
        var msg="";
        if($("#username").val().length == 0)
        {
            msg="请输入你的用户名!";
            alert(msg);
            return false;
        }
        if($("#password").val().length == 0)
        {
            msg="请输入您的密码!";
            alert(msg);
            return false;
        }
        if($("#username").val().length !== 0 && $("#password").val().length !== 0){
            $('#loading').removeClass('hidden');
        }
    }
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