/**
 * Created by xiaoguoquan on 2016/11/2.
 */
$(function () {
    //初始化轮播图--放在最后
    var mySwiper = new Swiper ('.swiper-container', {
        direction: 'horizontal',
//            loop: true,
//            freeMode : false,
        autoplay:3000,
        pagination: '.swiper-pagination',
        paginationClickable:true,
        speed:500
    });
    var $iosDialog2 = $("#iosDialog2");
    $('body').on('click', '.weui-dialog__btn', function(){
        $(this).parents('.js_dialog').fadeOut(200);
    });
    $('#askonline').on('click', function(){
        $iosDialog2.fadeIn(200);
    });
})