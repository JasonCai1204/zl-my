<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>登录提醒</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="css/user/home.css">
    <style type="text/css">
        .app_hd{
            width:100%;
            height:700px;
            font-size:18px;
            line-height: 24px;
            padding:0;
            font-weight: 300;
            box-sizing: border-box;
            margin:0;
            background-color: white;
            float:left;
        }
        .app_bd{
            width:100%;
            height:75px;
            font-size:18px;
            padding:15px;
            text-align: center;
            box-sizing: border-box;
            margin:147.5px 0 405.5px 0;
            line-height: 21px;
        }
        p{
            background-color: white;
            box-sizing: border-box;
            font-family: PingFangSC-Regular;
        }
        .typing{
            position: relative;
            margin-bottom: 30px;
            line-height:initial;
        }
        .typing span{
            position: absolute;
            display: block;
            color: white;
            font-size:28px;
            width:30.81px;
            height: 25px;
            line-height:25px;
            top:0;
            left:0;
            right:0;
            bottom:0;
            margin:auto;
        }
        .my_info_container{
            font-size:150px;
            font-family: PingFangSC-Regular;
        }
    </style>
</head>
<body style="background-color: rgb(239,239,248);margin: auto">

<!--固定在屏幕上部的logo-->
<div class="logo_part">
    <div class="logo">
        <a href="/" style="background-image: url('/storage/images/app/M_27w.png')"></a>
    </div>
</div>

<!--主体部分-->
<div class="container">
    <div class="app_hd">
        <div class="app_bd">
            <p>
                <span>您的帐号没有"肿瘤名医医生版"的使用权限，请使用"肿瘤名医用户版"。</span>
            </p>

            <div class="my_info_container" >
                <form action="http://www.zl-my.com" method="get">
                    <input type="submit" class="btnCommon" value="访问用户版">
                </form>
            </div>
        </div>

    </div>
</div>


</body>
</html>