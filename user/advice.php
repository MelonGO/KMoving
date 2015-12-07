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

    <script type="text/javascript" src="../js/jquery.more.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#more').more({'address': '../server/advice/advice_data.php'})
        });
    </script>

    <script>
        function ReadExcel()
        {
            var tempStr = "";
            var filePath= document.all.upfile.value;
            var oXL = new ActiveXObject("Excel.application");
            var oWB = oXL.Workbooks.open(filePath);
            oWB.worksheets(1).select();
            var oSheet = oWB.ActiveSheet;
            try{
                for(var i=2;i<46;i++)
                {
                    if(oSheet.Cells(i,2).value =="null" || oSheet.Cells(i,3).value =="null" )
                        break;
                    var a = oSheet.Cells(i,2).value.toString()=="undefined"?"":oSheet.Cells(i,2).value;
                    tempStr+=("  "+oSheet.Cells(i,2).value+
                    "  "+oSheet.Cells(i,3).value+
                    "  "+oSheet.Cells(i,4).value+
                    "  "+oSheet.Cells(i,5).value+
                    "  "+oSheet.Cells(i,6).value+"\n");
                }
            }catch(e)
            {
                document.all.txtArea.value = tempStr;
            }
            document.all.txtArea.value = tempStr;
            oXL.Quit();
            CollectGarbage();
        }
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
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h1 class="font-big font-white">
                建议</br>
                <small>健康建议</small>
            </h1>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
<!--            <form role="form" method="post" action="http://www.kmoving.com/server/advice/advice_excel.php">-->
                <div class="form-group pull-right">
                    <input type="file" id="inputfile" name="inputfile">
                </div>
                <button type="submit" onclick="import_excel()" class="pull-right btn btn-success fa fa-file-excel-o fa-2x">导入</button>
<!--            </form>-->
        </div>
        <p id="advice-import"></p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="http://www.kmoving.com/user/advice.php">我的建议</a></li>
                <li><a href="http://www.kmoving.com/user/advice_create.php">其他用户</a></li>
            </ul>
        </div>
    </div>
    <div id="more">
        <div class="single_item">
            <h3 class="title"></h3>
            <p class="content"></p>
            <p class="authorName"></p>
        </div>
        <a href="javascript:;" class="get_more">
            <button class="btn btn-block fa fa-refresh fa-2x">加载更多</button>
        </a>
    </div>
</div>

<script>
    function import_excel(){
        window.location.href = "http://localhost:63342/Sites/server/advice/advice_excel.php";
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