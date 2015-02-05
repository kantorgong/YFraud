Date.now = Date.now || function() { return +new Date; };
function openwinx(url,name,w,h) {
    if(!w) w=screen.width-4;
    if(!h) h=screen.height-95;

    window.open(url,name,"top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}
!function ($) {

  $(function(){
 	$('a.openwinx').on('click',function(){
       openwinx($(this).attr('href'));
        return false;
    });
  	$('.randKey').on('click',function(){

        len = $(this).data('keylen') || 31;

        chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        maxPos = chars.length;
        key = '';
        for (i = 0; i < len; i++) {
            key += chars.charAt(Math.floor(Math.random() * maxPos));
        }

       if($(this).data('forinput') != undefined)
            $($(this).data('forinput')).val(key);
    })

  });
}(window.jQuery);