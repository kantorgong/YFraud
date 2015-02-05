(function($) {
    $(function() {
        $('.tab_zp_ct').eq(0).show();
        $('.tab_zp').on('click', function(){
            if($("input[type=checkbox]").eq($(this).index()).is(':checked')){
                $('.tab_zp_ct').eq($(this).index()).show(); 
            }
            else
            {
                $('.tab_zp_ct').eq($(this).index()).hide();
            }
            //$('.tab_zp_ct').eq($(this).index()).show().siblings().hide();
        });

        $('.tab_zp_ct').on('click', '.btn_zj', function(){
            var index = $(this).parents('.tab_zp_ct').index();
            var $name = $('.tab_zp').eq(index).text();
            var $type;
            //获取input名字
            var obj_title = $(this).parents('.tab_zp_ct').find("input").attr("name");
            //if(index == 4){ $type = 'url'}else if(index == 3){$type = 'text'}else{$type = 'number'}
            $type = 'text';
            $(this).parents('.tab_zp_ct').append('<div class="label1"><span class="name">诈骗' + $.trim($name) + '：</span><input type="'+$type+'" name="'+obj_title+'"  class="txt_zp">&nbsp;<a href="javascript:;" class="btn_zj">增加</a>&nbsp;<a href="javascript:;" class="btn_sc">删除</a></div>');
        });
        $('.tab_zp_ct').on('click', '.btn_sc', function(){
           if($(this).parents('.tab_zp_ct').children('.label1').length > 1){
            $(this).parents('.label1').remove();
        }

        });

        $('#setText').on('blur', function() {
            if ($.trim($('#setText').val()).length >= 2) {
                $('#tagText').append('<li>' + $(this).val() + '<a href="javascript:;">X</a></li>');
                $(this).val('');
            } else if ($.trim($('#setText').val()).length == 1) {
                if ($('#box').find('span').length == 0) {
                    $('#box').append('<span style="color:#f00">请输入最少两个字</span>');
                }
            }
        });
        $('#setText').on('focus', function() {
            $('#box').find('span').remove();
        });
        $('#tagText').on('click', 'li>a', function() {
             $(this).parent().remove();
        });
    })
})(jQuery);