/**
 * Created by xiaoguoquan on 2016/11/2.
 */
$(function () {
    var mask = $('#mask');
    var weuiActionsheet = $('#weui-actionsheet');
    function hideActionSheet(weuiActionsheet, mask) {
        weuiActionsheet.removeClass('weui-actionsheet_toggle');
        mask.removeClass('actionsheet__mask_show');
        weuiActionsheet.on('transitionend', function () {
            mask.css({
                'display':'none',
                'background-color':'transparent'
            });
        }).on('webkitTransitionEnd', function () {
            mask.css({
                'display':'none',
                'background-color':'transparent'
            });
        })
    }
    $(".weui-media-box").on('click',function () {
        weuiActionsheet.addClass('weui-actionsheet_toggle');
        mask.show().focus().addClass('actionsheet__mask_show').css('background-color','rgba(0,0,0,.6)').one('click', function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        $('#actionsheet_cancel').one('click', function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
    })
});