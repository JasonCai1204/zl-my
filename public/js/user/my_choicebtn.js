/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function () {
    $("[type = 'submit']").addClass('btnDisable');
    if($("[checked]").length > 0){
        $("[type = 'submit']").removeClass('btnDisable');
    }
    $(".weui-check__label").on('click',function () {
        $("[type = 'submit']").removeClass('btnDisable');
    })
})
