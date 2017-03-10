function confirmDelete() {
    var sign = prompt('键入 "DELETE" 来删除：');

    if (sign == "DELETE") {
        $('#deleteForm').submit();
    } else if (sign != null) {
        alert("键入有误，删除失败。");
    }
}

function recommendCheck() {
    if($("#is_recommended").is(':checked') || $("#is_recommended_1").is(':checked')){
        $("#recommendImage").show()
    }else{
        $("#recommendImage").hide()
    }
}

$(function () {
    var eidtor = new Simditor({
        textarea: $('#editor'),
        toolbar: [
            'title',
            'bold',
            // 'color',
            // 'ol',
            // 'ul',
            // 'blockquote',
            'link',
            'image',
            'alignment',
            // 'indent',
            // 'outdent',
            'hr',
        ],
        imageButton: 'upload',
        defaultImage: '/storage/images/helper/photo/default.png',
        upload : {
            url : '/helper/upload-file',
            params: {'_token': window.Laravel.csrfToken, 'path': $('#editor').data('path')},
            fileKey: 'upload_file',
            connectionCount: 3,
            leaveConfirm: '文件上传中，您要离开页面吗？'
        },
    });

    if($("#is_recommended").is(':checked') || $("#is_recommended_1").is(':checked')){
        $("#recommendImage").show()
    }else{
        $("#recommendImage").hide()
    };

});
