/**
 * Created by xiaoguoquan on 2016/11/9.
 */
$(function () {
    if($(".weui-tabbar__item").length == 4){
        $(".weui-tabbar__item").siblings().removeClass('my_tabbar_click');
        var itemarr = ['container_home','container_news','container_recommend','container_user'];
        var itemid = $(".container").attr("id");
        var index = itemarr.indexOf(itemid);
        $(".weui-tabbar__item").eq(index).addClass('my_tabbar_click').siblings().removeClass('my_tabbar_click');
    }

})