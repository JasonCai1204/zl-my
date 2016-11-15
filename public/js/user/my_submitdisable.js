/**
 * Created by xiaoguoquan on 2016/10/18.
 */
$(function () {
    $("[type = 'submit']").addClass('btnDisable');
    $('[required]').on('input propertychange',function () {
        for(var i = 0 ;i<$('[required]').length; i++){
            var textflig = true;
            if($('[required]').eq(i).val() == ''){
                textflig = false;
                break;
            }
        }
        if(textflig == true){
            $("[type = 'submit']").removeClass('btnDisable')
        }else{
            $("[type = 'submit']").addClass('btnDisable')
        }
    });
});
