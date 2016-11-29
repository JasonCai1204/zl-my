/**
 * Created by xiaoguoquan on 2016/11/9.
 */
;$(function () {
    console.log('use')
    if($(".weui-tabbar__item").length == 4){
        console.log(1);
        $(".weui-tabbar__item").siblings().removeClass('my_tabbar_click');
        var itemarr = ['container_home','container_news','container_recommend','container_account'];
        var itemid = $(".container").attr("id");
        var index = itemarr.indexOf(itemid);
        if(index > -1){
            console.log(2);
            var srcstring = $(".weui-tabbar__item").eq(index).children('img').attr('src');
            var newsrc = srcstring.substring(0,$(".weui-tabbar__item").eq(index).children('img').attr('src').lastIndexOf('.')) + "-click.png";
            $(".weui-tabbar__item").eq(index).addClass('my_tabbar_click').siblings().removeClass('my_tabbar_click');
            $(".weui-tabbar__item").eq(index).children('img').attr('src',newsrc);
            console.log(newsrc)

        }else{
            console.log(index)
        }
    }
//11-28修改完成
});