/**
 * Created by xiaoguoquan on 2016/11/2.
 */
$(function () {
    var u = navigator.userAgent;
    var ua = navigator.userAgent.toLowerCase();
    var isAndroid = u.indexOf('Android') > -1 || ua.indexOf('Adr') > -1;
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
    if (isiOS) {
        $(".weui-search-bar__box .weui-search-bar__input").css('padding' , '7px 0 5px')
    } else if (isAndroid) {
        $(".weui-search-bar__box .weui-search-bar__input").css('padding' , '9px 0 4px')
    };
    var mySwiper = new Swiper('.swiper-container', {
        direction: 'horizontal',
        autoplay: 3000,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        speed: 500
    });
    var $iosDialog2 = $("#iosDialog2");
    var focus = false;
    var winW = $(window).width() >= 667 ? 667 : $(window).width(),
        panH = winW * 200 / 375,
        swiH = winW * 150 / 375,
        winH, domH;
    var $searchBar = $('#searchBar'),
        $form = $('.weui-search-bar__form'),
        $searchhid = $('#searchhidden'),
        $searchbd = $('#searchbd'),
        $searchResult = $('#searchResult'),
        $searchText = $('#searchText'),
        $searchInput = $('#searchInput'),
        $searchClear = $('#searchClear'),
        $searchCancel = $('#searchCancel');
    function hideSearchResult() {
        $searchResult.hide();
        $searchInput.val('');
    };
    function cancelSearch() {
        hideSearchResult();
        focus = false;
        $searchBar.addClass('testshearch').removeClass('weui-search-bar_focusing');
        $('.my_home_header').height(panH);
        $form.css('background-color', 'transparent');
        $searchhid.css('display', 'block');
        $searchbd.css({
            'display': 'none',
            'height': 0
        })
        $searchText.show();
    };
    $('body').on('click', '.weui-dialog__btn', function () {
        $(this).parents('.js_dialog').fadeOut(200);
    });
    $('#askonline').on('click', function () {
        $iosDialog2.fadeIn(200);
    });
    $('.my_home_header').height(panH);
    $('.swiper-container').height(swiH);
    if (domH < winH) {
        $('.my_home_msg').css({
            'position': 'fixed',
            'left': 0,
            'bottom': 0,
            'width': '100%',
            'margin-bottom': '64px',
            'text-align': 'center'
        })
    } else {
        $('.my_home_msg').removeAttr('style');
    };
    $(window).resize(function () {
        winW = $(window).width() >= 667 ? 667 : $(window).width();
        panH = winW * 200 / 375;
        swiH = winW * 150 / 375;
        winH = $(window).height();
        domH = $('body').height();
        if (!focus) {
            $('.my_home_header').height(panH);
        }
        $('.swiper-container').height(swiH);
        winH = $(window).height();
        domH = $('body').height();
        if (domH + 53 < winH) {
            $('#container_home .my_home_msg').addClass('msgfiexd')
        } else {
            $('.my_home_msg').removeClass('msgfiexd');
        }
    });
    if ($('#searchhidden').length > 0) {
        $searchText.on('click', function () {
            focus = true;
            $searchBar.addClass('weui-search-bar_focusing').removeClass('testshearch');
            $('.my_home_header').height('53px');
            $form.css('background-color', '#efeff4');
            $searchInput.focus();
            $searchhid.css('display', 'none');
            $searchbd.css({
                'display': 'block',
                'height': $(window).height() - 53 - 48
            })
            $searchClear.hide();
        });
        $searchInput
            .on('blur', function () {
                if (!this.value.length) cancelSearch();
            })
            .on('input', function () {
                if (this.value.length) {
                    $searchClear.show();
                } else {
                    $searchClear.hide();
                }
            });
        $searchClear.on('click', function () {
            hideSearchResult();
            $searchInput.focus();
            $searchClear.hide();
        });
        $searchCancel.on('click', function () {
            cancelSearch();
            $searchInput.blur();
        });
    }
})