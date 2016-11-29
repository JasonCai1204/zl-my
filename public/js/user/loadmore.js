/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function(){

        var counter = 1;
        var pageStart = 0,pageEnd = 10;

        // dropload
        $('.content').dropload({
            scrollArea : window,

            domDown : {
                domClass   : 'dropload-down',
                domRefresh : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>上拉加载更多</span></div>",
                domLoad    : "<div class='weui-loadmore'><i class='weui-loading'></i><span class='weui-loadmore__tips'>正在加载</span></div>",
                domNoData  : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>正在加载</span></div>"
            },

            loadDownFn : function(me){
                $.getJSON( '/loadmore', { 'counter': counter }, function(data) {
                        var result = '';
                        counter++;
                        for(var i = pageStart; i < pageEnd; i++){
                            result +=   '<a class="my_advice_list" href= http://127.0.0.1:8000/news/'+ data.data[i].id+'>'
                                +'<img src='+ data.data[i].cover_image +' alt="">'
                                +'<span>'+ data.data[i].title +'</span>'
                                +'</ a>';
                            if((i + 1) >= data.data.length){
                                me.lock();
                                me.noData();
                                break;
                            }
                        }
                        setTimeout(function(){
                            $('.lists').append(result);
                            me.resetload();
                            $(".weui-loadmore__tips").text("已无更多")
                        },1000);
                    });
            },
            threshold : 50
        });
});
