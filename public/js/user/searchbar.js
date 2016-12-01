/**
 * Created by xiaoguoquan on 2016/11/2.
 */
$(function () {
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

        //搜索框点击切换
        var $searchBar = $('#searchBar'),
            $searchResult = $('#searchResult'),
            $searchText = $('#searchText'),
            $searchInput = $('#searchInput'),
            $searchClear = $('#searchClear'),
            $searchCancel = $('#searchCancel');
        $searchBar.addClass('weui-search-bar_focusing');
        $searchInput.focus();
        function hideSearchResult(){
            $searchResult.hide();
            $searchInput.val('');
        }
        function cancelSearch(){
            hideSearchResult();
            $searchBar.removeClass('weui-search-bar_focusing');
            $searchText.show();
        }

        $searchText.on('click', function(){
            $searchBar.addClass('weui-search-bar_focusing');
            $searchInput.focus();
        });
        $searchInput
            .on('blur', function () {
                if(!this.value.length) cancelSearch();
            })
            .on('input', function(){
                if(this.value.length) {
                    $searchResult.show();
                } else {
                    $searchResult.hide();
                }
                $(".weui-icon-search").css({
                })
            })
        ;
        $searchClear.on('click', function(){
            hideSearchResult();
            $searchInput.focus();
        });
        $searchCancel.on('click', function(){
            cancelSearch();
            $searchInput.blur();
        });
    });

});