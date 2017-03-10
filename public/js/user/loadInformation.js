/**
 * Created by xiaoguoquan on 2017/1/22.
 */


$(function () {
    if($("[type='hidden']").eq(0).val() == 'false'){
        $(".loadBtnOuter").hide();
        $("#container_news").css('margin-bottom', '30px')
    }
    var index = 0;
    var offsetH = $(".classifyInformation").offset().top;
    $(".classifyItem").click(function () {
        index = $(this).index();
        $(".classifyItem").siblings().removeClass('itemclick').eq(index).addClass('itemclick').parent().removeClass('filter_fixed');
        $(".infomation-cells").siblings().hide().eq(index).show();
        if($("[type='hidden']").eq(index).val() == 'false'){
            $(".loadBtnOuter").hide();
            $("#container_news").css('margin-bottom', '30px')
        }else{
            $(".loadBtnOuter").show();
            $("#container_news").css('margin-bottom', 0)
        }
    });
    $("#loadInformation").click(function () {
        $(this).html("正在加载").parent('p').append('<i class="weui-loading"></i>')
        var data = $("[type = 'hidden']").eq(index).val();
        var number = $(".infomation-cells").eq(index).find('a').length;
        $.getJSON('loadmore',{data:data,skip:number})
            .done(function (data) {
                if(data.data.length > 0){
                    var informations = '';
                    for(var i=0; i<data.data.length; i++){
                        informations += "<a href='/news/" +
                            data.data[i].id
                            + "' class='information-cell'><img src='storage/" +
                            data.data[i].cover_image
                            + "' alt='' class='information-cell__hd'><div class='information-cell__bd'><p>" +
                            data.data[i].title
                            + "</p></div></a>"
                    }
                    if(data.count){
                        $(".weui-loading").remove();
                        $("#loadInformation").html("查看更多");
                    }else{
                        $("[type='hidden']").eq(index).val('false');
                        $("#loadInformation").html("查看更多");
                        $(".weui-loading").remove();
                        $(".loadBtnOuter").hide();
                        $("#container_news").css('margin-bottom','30px')
                    }
                    $(".infomation-cells").eq(index).append(informations);
                }
            })
    });
})
