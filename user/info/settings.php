<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KMoving - Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="../../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/mystyle.css" rel="stylesheet">
    <link href="../../css/queries.css" rel="stylesheet">
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

<div class="container-fluid user-settings">
    <div class="row font-white" style="opacity: 0.8">
        <h1 class="font-big">
            账户设置
        </h1>
        <form role="form" action="http://www.kmoving.com/server/user/settings.php" method="post">
            <div class="form-group">
                <label for="name">姓名：</label>
                <input type="text" class="form-control input-lg" readonly="readonly" name="name" id="name" value="<?php echo $_GET["name"];?>">
            </div>
            <div class="form-group">
                <label for="gender">性别：</label>
                <select class="form-control input-lg" name="gender" id="gender">
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
            </div>
            <div class="form-group">
                <label for="height">身高：</label>
                <input type="text" class="form-control input-lg" name="height" id="height" value="<?php echo $_GET["height"];?>">
            </div>
            <div class="form-group">
                <label for="weight">体重：</label>
                <input type="text" class="form-control input-lg" name="weight" id="weight" value="<?php echo $_GET["weight"];?>">
            </div>
            <div class="form-group">
                <label for="birth">生日：</label>
                <input type="date" class="form-control input-lg" name="birth" id="birth" value="<?php echo $_GET["birth"];?>">
            </div>
            <div class="form-group">
                <label for="country">国家：：</label>
                <input type="text" class="form-control input-lg" name="country" id="country" value="<?php echo $_GET["country"];?>">
            </div>
            <div class="form-group">
                <label for="city">城市：：</label>
                <input type="text" class="form-control input-lg" name="city" id="city" value="<?php echo $_GET["city"];?>">
            </div>
            <div class="form-group">
                <label for="address">地址：</label>
                <input type="text" class="form-control input-lg" name="address" id="address" value="<?php echo $_GET["address"];?>">
            </div>
            <button type="submit" class="btn btn-info btn-block fa fa-save fa-2x"></button>
        </form>
    </div>
    <div><p></p></div>
</div>

<script>
    var sel = document.getElementById("gender");
    var val = "<?php echo $_GET["gender"];?>";
    for(var i = 0; i<sel.length; i++){
        if(sel.options[i].value == val){
            sel.options[i].selected = 'selected';
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