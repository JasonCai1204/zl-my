/**
 * Created by xiaoguoquan on 16/9/30.
 */
$(function () {
    function getObjectURL(file) {
        var url = null ;
        if (window.createObjectURL!=undefined) {
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) {
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) {
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    };
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
    var thisfile , fileindex , url , fileslength , fileboxlength , ImgUrlList = [] , ImgFileList = [] , thisfiles;
    var mask = $('#mask');
    var weuiActionsheet = $('#weui-actionsheet');

    $(".weui-uploader__input").on("change",function(){
        thisfiles = this.files;
        fileslength = thisfiles.length;
        fileboxlength = 0 || $('.weui-uploader__file').length;
        for(var i=0 ; i<fileslength; i++){
            ImgFileList.push(thisfiles[i]);
            if(getObjectURL(thisfiles[i])){
                $("<li class='weui-uploader__file weui-uploader__file_status' style='background-image: url("+ getObjectURL(thisfiles[i]) +")'>" + "<div class='weui-uploader__file-content'>" + "<i class='weui-loading'></i>" + "</div>" + "</li>").appendTo($(".weui-uploader__files"));
                var formData = new FormData();
                formData.append('file',thisfiles[i]);
                $.ajax({
                    url:'', //预约单页面上传图片接口，返回图片标识（名称或连接等）
                    type:'POST',
                    cache:false,
                    async: false,             //使用同步上传,避免ajax还没操作完for循环结束
                    data: formData,           //formdata属于二进制文件,需测试是否能完全转化成图片
                    processData: false,
                    contentType: false
                }).done(function (res) {
                    if(res){
                        $(".weui-uploader__file").eq(fileboxlength + i).removeClass('weui-uploader__file_status').children('div').remove();
                        ImgUrlList.push(res);
                    }
                }).fail(function () {
                    $(".weui-uploader__file").eq(fileboxlength + i).attr('data_flag','false');
                    $(".weui-uploader__file-content").eq(fileboxlength + i).html("<i class='weui-icon-warn'></i>");
                });
            };
        };
        $("[type='hidden']").val(ImgUrlList.join(','));
        $(".weui-uploader__file").on('click',function () {
            thisfile = $(this);
            fileindex = $(this).index();
            url = thisfile.css('background-image');
            if(thisfile.has($(".weui-icon-warn")).length >= 1){
                weuiActionsheet.addClass('weui-actionsheet_toggle');
                mask.show().focus().addClass('actionsheet__mask_show').css('background-color','rgba(0,0,0,.6)').one('click', function () {
                    hideActionSheet(weuiActionsheet, mask);
                });
                $('#actionsheet_cancel').one('click', function () {
                    hideActionSheet(weuiActionsheet, mask);
                });
                weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
            }else{
                $("#gallery").show().css({
                    'background-image':url,
                    'background-size':'100%',
                    'background-repeat':'no-repeat',
                    'background-position':'center center',
                    'opacity':1
                }).on('click',function () {
                    $("#gallery").hide().css('opacity',0)
                });
                $('.weui-icon_gallery-delete').on('click',function () {
                    $("#gallery").hide().css('opacity',0);
                    thisfile.remove();
                    ImgUrlList.splice(fileindex,1);
                    ImgFileList.splice(fileindex,1);
                    $("[type='hidden']").val(ImgUrlList.join(','));
                })
            }

        })
    });
    $(".my_order_reuploader").on('click',function () {
        hideActionSheet(weuiActionsheet, mask);
        //上传失败后重新上传的ajax
        var formData = new FormData();
        formData.append('file',ImgFileList[fileindex]);
        $.ajax({
            url:'', ////预约单页面上传图片接口，返回图片标识（名称或连接等）
            type:'POST',
            cache:false,
            data: formData,           //formdata属于二进制文件,需测试是否能完全转化成图片
            processData: false,
            contentType: false
        }).done(function (res) {
            if(res){
                $(thisfile).removeClass('weui-uploader__file_status').children('div').remove();
                ImgUrlList.splice(fileindex,0,res);
            }
        });
    });
    $(".my_order_delimg").on('click',function () {
        hideActionSheet(weuiActionsheet, mask);
        thisfile.remove();
        ImgUrlList.splice(fileindex,1);
        ImgFileList.splice(fileindex,1);
        $("[type='hidden']").val(ImgUrlList.join(','));
    })
});