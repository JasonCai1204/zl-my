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
        }else{
            textflig = true;
            textflig ? $("[type = 'submit']").removeClass('btnDisable') : $("[type = 'submit']").addClass('btnDisable');
        }
    }
    $('[required]').on('input propertychange',function () {
        for(var i = 0 ;i<$('[required]').length; i++){
            if($('[required]').eq(i).val() == ''){
                textflig = false;
                break;
            }else{
                textflig = true;
            }
        }
        textflig ? $("[type = 'submit']").removeClass('btnDisable') : $("[type = 'submit']").addClass('btnDisable');
    });
    textflig ? $("[type = 'submit']").removeClass('btnDisable') : $("[type = 'submit']").addClass('btnDisable');
});
