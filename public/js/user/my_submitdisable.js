/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function () {
    var textflig = true;
    $("[type = 'submit']").addClass('btnDisable');
    for(var i = 0 ;i<$('[required]').length; i++){
        if($('[required]').eq(i).val() == ''){
            textflig = false;
            break;
        }
    }
    $('[required]').on('input propertychange',function () {
        if($(this).parents('div.weui-cell').hasClass('weui-cell_warn')){
            $(this).parents('div.weui-cell').removeClass('weui-cell_warn');
            $(this).parents('div.weui-cell').find('div.weui-cell__ft').remove();
        }
        for(var i = 0 ;i<$('[required]').length; i++){
            if($('[required]').eq(i).val() == ''){
                textflig = false;
                break;
            }else{
                textflig = true;
            }
        }
        if(textflig == true){
            $("[type = 'submit']").removeClass('btnDisable')
        }else{
            $("[type = 'submit']").addClass('btnDisable')
        };

    });
    if(textflig == true){
        $("[type = 'submit']").removeClass('btnDisable')
    }else{
        $("[type = 'submit']").addClass('btnDisable')
    }
});
