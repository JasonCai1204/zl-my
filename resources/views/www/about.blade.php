<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>关于我们</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="css/user/weui.min.css">
    <link rel="stylesheet" href="css/user/home.css">
    <style type="text/css">
        .special_cells_access .weui-cell__ft:after{
            content:'+';
            border:0;
            -webkit-transform:rotate(0deg);
            transform:rotate(0deg);
            right:4px;
            top:-8px;
        }
    </style>
</head>
<body style="background-color: white">

<!--固定在屏幕上部的logo-->
<div class="logo_part">
    <div class="logo">
        <a href="/" style="background-image: url('/storage/images/app/web/www/mobile-titlebar-logo.png');"></a>
    </div>
</div>

<!--主体部分-->
<div class="container" style="padding-bottom: 30px;">
    <div class="my_aboutus_head">
        <img src="/storage/images/app/web/www/user-mobile-about-slogan.png" alt="">
    </div>
    <div class="my_aboutus_cell">
        <p class="my_aboutus_cellhd">我们做什么</p>
        <p class="my_aboutus_cellbd">建立专业的移动互联平台，帮助更多的肿瘤患者找对名医，守护生命健康！</p>
    </div>
    <div class="my_aboutus_cell">
        <p class="my_aboutus_cellhd">我们怎么做</p>
        <p class="my_aboutus_cellbd">通过互联网+，一端联系庞大的肿瘤患者群体，一端聚集顶级肿瘤专家，在此平台上实现快速对接，同时引入保险和第三方医疗机构，保障整体体系的高效安全运转。</p>
    </div>
    <div class="weui-cells weui-cell_access special_cells_access" style="margin-top:0">
        <a href="javascript:;" class="weui-cell">
            <div class="weui-cell__bd weui-cell_primary">
                <p style="color: #000;">CEO寄语</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <div class="weui-cells__tips" style="font-size: 14px; color: rgb(53,53,53); margin-top: 15px; display: none;" id="ceo-address">
        <p style="text-indent: 28px;">
            本人原就职于世界 500 强公司抗肿瘤事业部，两年前离开外企，和朋友创立了一家生物科技公司，可这两年，依然不停的接到电话，就是拜托我帮忙介绍医生看病，特别和肿瘤相关的越来越多。
        </p>
        <p style="text-indent: 28px;">
            今年端午，听到一消息，原先老家邻居一叔叔得了食管癌，听信外面医托，举家前往外地就医，花费了大量金钱精力，然而并没找到正规的医院医生，最终错过最佳治疗时机，失去了宝贵的生命。
        </p>
        <p style="text-indent: 28px">
            这位叔叔我很熟悉，过年回家还一起喝茶，而从发病到最后离去，居然不到半年！
        </p>
        <p style="text-indent: 28px;">
            这给我巨大的震撼。他为什么会听信街边医托广告？又有多少人与他一样确诊后乱了分寸？我们是不是应该做些事情来帮助他们？
        </p>
        <p style="text-indent: 28px">
            所以，我和一群有同样理想的伙伴，下定决心做这件事情，把各方资源整合起来，帮助有需要的肿瘤患者在第一时间找对名医，因为治疗不能等待，生命不可重来。也希望我们，所提供的专业服务可以帮助到更多的患者，少一点由于误信街边广告而失去的遗憾，让医疗咨询这事更专业，因为这不是一个普通的服务，在提供该服务的同时要记住你所承担的责任，那就是对生命健康的守护！
        </p>
    </div>
</div>
<script src="js/user/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    var isHide = true;
    $(".container").on('click','.special_cells_access',function () {
        if(isHide){
            $('#ceo-address').slideDown();
            $('.special_cells_access .weui-cell__ft').after().css({
                'transform':'rotate(45deg)',
                'right':'-2px'
            })
            isHide = false;
        }else{
            $('#ceo-address').slideUp();
            $('.special_cells_access .weui-cell__ft').after().css({
                'transform':'rotate(0deg)',
            })
            isHide = true;
        }
    })
</script>
</body>
</html>