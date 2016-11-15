/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function () {
    $("[type = 'submit']").addClass('btnDisable');
    $(".weui-check__label").on('click',function () {
        var index;
        var a = new Array;
        a = $(".weui-check__label");
        index = $(".weui-check__label").index($(this));
        $(".weui-icon-checked").hide().eq(index).show();
        $("[type = 'submit']").removeClass('btnDisable');
    })
})
