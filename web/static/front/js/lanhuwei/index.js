(function($) {
	$(function() {
		var $sld = $('#slide li');
        var index = 0;
        var timer;
        var $len = $sld.length;
        $('#slide').wrapInner('<ul class="wrapper"></ul>');
        $('ul.wrapper').css({position : 'absolute','width' : $sld.
            outerWidth() * ($sld.length + 1)});
        $('div.sld').on('mouseenter', function(){
            clearInterval(timer);
        }).on('mouseleave', function(){
            timer = setInterval(function() {
            showpic(index);
            index++;
            if(index == $len - 3) {index = 0;}
        },2000);
        }).trigger('mouseleave');
        $('#next').on('click', function(){
        	if(!$('ul.wrapper').is(':animated')){
	            index++;
	            if(index == $len - 3) {index = 0;}
	            showpic(index);
	        }
        });
        $('#prev').on('click', function(){
        	if(!$('ul.wrapper').is(':animated')){
	            index--;
	            if(index == -1) {index = $len - 4;}
	            showpic(index);
	        }
        });
        function showpic(index){
            $('ul.wrapper').animate({
                left: -$sld.outerWidth() * index
            },500);
        };
	})
})(jQuery);