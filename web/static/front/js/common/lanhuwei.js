(function($) {
	$(function() {
        var $showobj = $('div.so_ct');
        $showobj.eq(0).show();
        $('ul.so_tit>li').on('mouseover', function(){
            $(this).addClass('cur').siblings('li').removeClass('cur');
            $showobj.eq($(this).index()).show().siblings('div').hide();
        });
	})
})(jQuery);