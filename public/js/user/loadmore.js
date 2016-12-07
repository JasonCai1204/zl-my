/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function(){
        var counter = 1;
        var pageStart = 0,pageEnd = 10;
        var winH = $(window).width();
        var imgH = winH*0.46875;
        $('.my_advice_list img').height(imgH);
        $('.my_advice_list').height(imgH);
        $(window).resize(function(){
            winH = $(window).width();
            imgH = winH*0.46875;
            $('.my_advice_list img').height(imgH);
            $('.my_advice_list').height(imgH);
        });

        // dropload
        $('#container_news').dropload({
            scrollArea : window,
            domDown : {
                domClass   : 'dropload-down',
                domRefresh : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>加载更多</span></div>",
                domLoad    : "<div class='weui-loadmore'><i class='weui-loading'></i><span class='weui-loadmore__tips'>正在加载</span></div>",
                domNoData  : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>上拉加载更多</span></div>"
            },
            loadDownFn : function(me){
                $.getJSON( '/loadmore', { 'counter': counter }, function(data) {
                        var result = '';
                        counter++;
                        if(data.data[0]){
                            for(var i = pageStart; i < pageEnd; i++){
                                result +=   '<a class="my_advice_list" href= http://zl-my.com:8000/news/'+ data.data[i].id+'>'
                                    +'<img src='+ data.data[i].cover_image +' alt="">'
                                    +'<span>'+ data.data[i].title +'</span>'
                                    +'</ a>';
                                if((i + 1) >= data.data.length){
                                    me.lock();
                                    me.noData();
                                    $(".weui-loadmore__tips").text("已展示全部资讯");
                                    break;
                                }
                            }
                            setTimeout(function(){
                                $('.lists').append(result);
                                me.resetload();
                            },1000);
                        }else{
                            me.lock();
                            me.noData();
                            $('.weui-loadmore').find('i').remove();
                            $(".weui-loadmore__tips").text("已展示全部资讯")
                        }

                    });
            },
            threshold : 50
        });
});
