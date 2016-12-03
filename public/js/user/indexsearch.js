/**
 * Created by xiaoguoquan on 2016/12/3.
 */
$(function () {
    var $searchBar = $('#searchBar'),
        $form = $('.weui-search-bar__form'),
        $searchbd = $('#searchbd'),
        $searchhid = $('#searchhidden'),
        $searchResult = $('#searchResult'),
        $searchText = $('#searchText'),
        $searchInput = $('#searchInput'),
        $searchClear = $('#searchClear'),
        $searchCancel = $('#searchCancel');
    var searchbdH = $(window).height() - 48 - 44 - 49 + 'px';
    function hideSearchResult(){
        $searchResult.hide();
        $searchInput.val('');
    }
    function cancelSearch(){
        hideSearchResult();
        $searchBar.addClass('testshearch').removeClass('weui-search-bar_focusing');
        $('.my_home_header').height('131px');
        $form.css('background-color','transparen');
        $searchhid.css('display','block');
        $searchbd.css({
            'display':'none',
            'height':searchbdH
        })
        $searchText.show();
    }

    //判断iOS||android 设备
    $(function(){
        var u = navigator.userAgent;
        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
        var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
        if(isiOS){
            $(".weui-search-bar__box .weui-search-bar__input").css({
                'padding':'7px 0 5px',
            })
        }else if(isAndroid){
            $(".weui-search-bar__box .weui-search-bar__input").css({
                'padding':'8px 0 4px'
            })
        };
    });

    if($('#searchhidden').length > 0){
        $searchText.on('click', function(){
            $searchBar.addClass('weui-search-bar_focusing').removeClass('testshearch');
            $('.my_home_header').height('44px');
            $form.css('background-color','#efeff4');
            $searchInput.focus();
            $searchhid.css('display','none');
            $searchbd.css({
                'display':'block',
                'height':searchbdH
            });
            $searchClear.hide();
        });
        $searchInput
            .on('blur', function () {
                if(!this.value.length) cancelSearch();
            })
            .on('input', function(){
                if(this.value.length) {
                    $searchClear.show();
                } else {
                    $searchClear.hide();

                }
            })
        ;
        $searchClear.on('click', function(){
            hideSearchResult();
            $searchInput.focus();
            $searchClear.hide();
        });
        $searchCancel.on('click', function(){
            cancelSearch();
            $searchInput.blur();
        });
    }
    //搜索框点击切换




});