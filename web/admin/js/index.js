$task_content_inner = null;
$mainiframe=null;
var tabwidth=119;
$loading=null;
$nav_wraper=$("#nav_wraper");
$(function () {
	$mainiframe=$("#mainiframe");
	$content=$("#content");
	$loading=$("#loading");
	var headerheight=45;
	$content.height($(window).height()-headerheight);
    $('body').height($(window).height());
	
	$nav_wraper.height($(window).height()-headerheight-27);
	//$nav_wraper.niceScroll();
	$(window).resize(function(){
		$content.height($(window).height()-headerheight);
        $('body').height($(window).height());
		 calcTaskitemsWidth();
	});
	$("#content iframe").load(function(){
    	$loading.hide();
    });
    handle_side_menu();
    $task_content_inner = $("#task-content-inner");
   


   

    ///

    $(document).on("click",'.apps_container li', function () {
        var app = '<li><span class="delete" style="display:inline">×</span><img src="" class="icon"><a href="#" class="title"></a></li>';
        var $app = $(app);
        $app.attr("data-appname", $(this).attr("data-appname"));
        $app.attr("data-appid", $(this).attr("data-appid"));
        $app.attr("data-appurl", $(this).attr("data-appurl"));
        $app.find(".icon").attr("src", $(this).attr("data-icon"));
        $app.find(".title").html($(this).attr("data-appname"));
        $app.appendTo("#appbox");
        $("#appbox  li .delete").off("click");
        $("#appbox  li .delete").click(function () {
            $(this).parent().remove();
            return false;
        });
    });

    ///
    $("#tdshortcutsmor1").click(function () {
        $(".window").hide();
    });

    $(document).on("click", ".task-item", function () {
        var appid = $(this).attr("app-id");
        var $app = $('#' + appid);
        showTopWindow($app);
    });

    $(document).on("click",'#task-content-inner li', function () {
        //appiframe-settingserver

        $("#task-content-inner .current").removeClass("current");
        $(this).addClass("current");
        $(".appiframe").hide();
    	$('#appiframe-'+$(this).attr('app-id')).show();
    	return false;
    });

    $(document).on("dblclick","#task-content-inner li", function () {
    	closeapp($(this));
    	return false;

    });
    $(document).on("click","#task-content-inner a.macro-component-tabclose", function () {
    	closeapp($(this).parent());
        return false;
    });



    $("#refresh_wrapper").click(function(){
    	var $current_iframe=$("#content iframe:visible");
    	$loading.show();
    	//$current_iframe.attr("src",$current_iframe.attr("src"));
    	$current_iframe[0].contentWindow.location.reload();
    	return false;
    });

    calcTaskitemsWidth();
});
function calcTaskitemsWidth() {
//    var width = $("#task-content-inner li").length * tabwidth;
//    $("#task-content-inner").width(width);
//    if (($(window).width()-268-119- 30 * 2) < width) {
//        $("#task-content").width($(window).width() -268-119- 30 * 2);
//        $("#task-next,#task-pre").show();
//    } else {
//        $("#task-next,#task-pre").hide();
//        $("#task-content").width(width);
//    }
}

function close_current_app(){
	closeapp($("#task-content-inner .current"));
}

function closeapp($this){
	if(!$this.is(".noclose")){
		$this.prev().click();
    	$this.remove();
    	calcTaskitemsWidth();
    	$("#task-next").click();
	}
	 
}





var task_item_tpl ='<li class="macro-component-tabitem">'+
'<span class="macro-tabs-item-text"></span>'+
'<a class="macro-component-tabclose" href="javascript:void(0)" title="点击关闭标签"><span></span><b class="macro-component-tabclose-icon">x</b></a>'+
'</li>';

var appiframe_tpl='<iframe style="width:100%;height: 100%;" frameborder="0" class="appiframe"></iframe>';

function openapp(url, appid, appname, selectObj) {
    var $app = $("#task-content-inner li[app-id='"+appid+"']");

    $("#task-content-inner .current").removeClass("current");
    if ($app.length == 0) {
        var task = $(task_item_tpl).attr("app-id", appid).attr("app-url",url).attr("app-name",appname).addClass("current");
        task.find(".macro-tabs-item-text").html(appname);
        $task_content_inner.append(task);
        $(".appiframe").hide();
        $loading.show();
        $appiframe=$(appiframe_tpl).attr("src",url).attr("id","appiframe-"+appid);
        $appiframe.appendTo("#content");
        $appiframe.load(function(){
        	$loading.hide();
        });
        calcTaskitemsWidth();
    } else {
    	$app.addClass("current");
    	$(".appiframe").hide();
    	var $iframe=$("#appiframe-"+appid);
    	var src=$iframe.get(0).contentWindow.location.href;
    	src=src.substr(src.indexOf("://")+3);

    		$loading.show();
    		$iframe.attr("src",url);

            	$loading.hide();


    	$iframe.show();
    	$mainiframe.attr("src",url);
    }
    

    
  
}

function handle_side_menu() {
    $("#menu-toggler").on('click', function () {
        $("#sidebar").toggleClass("display");
        $(this).toggleClass("display");
        return false
    });
    var b = $("#sidebar").hasClass("menu-min");
    $("#sidebar-collapse").on('click', function () {
        $("#sidebar").toggleClass("menu-min");
        $(this).find('[class*="fa-"]:eq(0)').toggleClass("fa-angle-double-right");
        b = $("#sidebar").hasClass("menu-min");
        if (b) {
            $(".open > .submenu").removeClass("open")
        }
    });
    var a = "ontouchend" in document;
    $(".nav-list").on('click', function (g) {
        var f = $(g.target).closest("a");
        if (!f || f.length == 0) {
            return
        }
        if (!f.hasClass("dropdown-toggle")) {
            if (b && 'click' == "tap" && f.get(0).parentNode.parentNode == this) {
                var h = f.find(".menu-text").get(0);
                if (g.target != h && !$.contains(h, g.target)) {
                    return false
                }
            }
            return
        }
        var d = f.next().get(0);
        if (!$(d).is(":visible")) {
            var c = $(d.parentNode).closest("ul");
            if (b && c.hasClass("nav-list")) {
                return
            }
            c.find("> .open > .submenu").each(function () {
                if (this != d && !$(this.parentNode).hasClass("active")) {
                    $(this).slideUp(200).parent().removeClass("open")
                }
            })
        } else {
        }
        if (b && $(d.parentNode.parentNode).hasClass("nav-list")) {
            return false
        }
        $(d).slideToggle(200).parent().toggleClass("open");
        return false
    })
}


