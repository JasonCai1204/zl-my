/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function(){
    var counter = 0;
    var num = 4;
    var pageStart = 0,pageEnd = 0;

    // dropload
    $('.content').dropload({
        scrollArea : window,
        domUp : {
            domClass   : 'dropload-up',
            domRefresh : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>下拉刷新</span></div>",
            domUpdate  : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>松开刷新</span></div>",
            domLoad    : "<div class='weui-loadmore'><i class='weui-loading'></i><span class='weui-loadmore__tips'>正在刷新</span></div>"
        },
        domDown : {
            domClass   : 'dropload-down',
            domRefresh : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>上拉加载更多</span></div>",
            domLoad    : "<div class='weui-loadmore'><i class='weui-loading'></i><span class='weui-loadmore__tips'>正在加载</span></div>",
            domNoData  : "<div class='weui-loadmore'><span class='weui-loadmore__tips'>正在加载</span></div>"
        },
        loadUpFn : function(me){
            $.ajax({
                type: 'GET',
                url: '',         //返回  下拉刷新资讯列表  json文件的接口
                dataType: 'json',
                success: function(data){
                    var result = '';
                    for(var i = 0; i < data.data.length; i++){
                        result +=   '<a class="my_advice_list" href='+ data.data[i].link +'>'
                            +'<img src='+ data.data[i].pic +' alt="">'
                            +'<span>'+data.data[i].title+'</span>'
                            +'</a>';
                    }
                    setTimeout(function(){
                        $('.lists').html(result);
                        me.resetload();
                        counter = 0;
                        me.unlock();
                        me.noData(false);
                    },1000);
                },
                error: function(xhr, type){
                    alert('刷新错误');
                    me.resetload();
                }
            });
        },
        loadDownFn : function(me){
            $.ajax({
                type: 'GET',
                url: '',        //返回  上拉加载更多资讯  json文件的接口
                dataType: 'json',
                success: function(data){
                    var result = '';
                    counter++;
                    pageEnd = num * counter;
                    pageStart = pageEnd - num;
                    for(var i = pageStart; i < pageEnd; i++){
                        result +=   '<a class="my_advice_list" href='+ data.data[i].link +'>'
                            +'<img src='+ data.data[i].pic +' alt="">'
                            +'<span>'+ data.data[i].title +'</span>'
                            +'</a>';
                        if((i + 1) >= data.data.length){
                            me.lock();
                            me.noData();
                            break;
                        }
                    }
                    setTimeout(function(){
                        $('.lists').append(result);
                        me.resetload();
                    },1000);
                },
                error: function(xhr, type){
                    console.log("加载错误");
                    me.resetload();
                }
            });
        },
        threshold : 50
    });
});
