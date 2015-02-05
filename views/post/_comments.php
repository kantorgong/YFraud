<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Comment;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\components\Common;

$pageSize=5;
$pages = new Pagination(['totalCount' => Comment::find()->where(['post_id'=> $id])->andWhere('status=1 AND type=1')->count(), 'pageSize' => $pageSize, 'pageParam' => 'commentpage', 'pageSizeParam' => 'commentpagesizeparam']);
$comments=Comment::find()->where(['post_id'=> $id])->andWhere('status=1 AND type=1')->orderBy(['create_time' => SORT_DESC,])->all();

function renderItems($items,$parent,$id)
{  
	foreach ($items as $key => $value) {
		if ($parent->id==$value->parent_id) {
			if (isset($value->user)) {
				$username=$value->user->username;
				$avatar=$value->user->avatar;
				$url=Url::to(['user/view', 'id' => $value->user_id]);
			}else{
				$username=$value->author?$value->author:"游客";
				$avatar=Yii::$app->homeUrl."upload/avatar/default.png";
				$url="javascript:;";
			}


            echo '<div class="pl-post">'.
                '<img class="pl-avatar img-circle" style="width: 48px; height: 48px;" alt="'.Html::encode($username).'" src="'.$avatar.'">'.
                    '<div class="pl-post-body">'.
                            '<div class="pl-post-header">'.
                                    '<span>'.
                                    '<a href="#" title="'.Html::encode($username).'" class="pl-user popClick ">'.Html::encode($username).'</a>'.
                                    '</span>'.
                                    '<span class="pl-time" title="'.date("Y-m-d H:i:s", $value->create_time).'">'.Common::formatTime($value->create_time).'</span>'.
                            '</div>'.
                    '<div class="pl-post-content">'.
                            '<p>'.Html::encode($value->content).'</p>'.
                    '</div>'.
                    '<div class="ops"><a href="" class="comment-up" data-id="'.$value->id.'"><i class="glyphicon glyphicon-thumbs-up"></i> (<span>'.$value->up.'</span>)</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="comment-down" data-id="'.$value->id.'"><i class="glyphicon glyphicon-thumbs-down"></i> (<span>'.$value->down.'</span>)</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="comment-reply" data-id="'.$value->id.'" data-postid="'.$id.'" title="回复"><i class="glyphicon glyphicon-share-alt"></i></a></div>'.
                    '</div>'.
                renderItems($items,$value,$id);
            '</div>';

		}
	 } 
}
function Comments($items,$pages,$id){

	foreach ($items as $key => $value) {
		
		if ($key>=$pages->offset && $key<$pages->offset+$pages->limit) {
			if ($value->parent_id==0) {
				if (isset($value->user)) {
					$username=$value->user->username;
					$avatar=$value->user->avatar;
					$url=Url::to(['user/view', 'id' => $value->user_id]);
				}else{
					$username=$value->author?$value->author:"游客";
					$avatar=Yii::$app->homeUrl."upload/avatar/default.png";
					$url="javascript:;";
				}


                echo '<li class="pl-post">'.
                    '<img class="pl-avatar img-circle" style="width: 48px; height: 48px;" alt="'.Html::encode($username).'" src="'.$avatar.'">'.
                    '<div class="pl-post-body">'.
                    '<div class="pl-post-header">'.
                    '<span>'.
                    '<a href="#" title="'.Html::encode($username).'" class="pl-user popClick ">'.Html::encode($username).'</a>'.
                    '</span>'.
                    '<span class="pl-time" title="'.date("Y-m-d H:i:s", $value->create_time).'">'.Common::formatTime($value->create_time).'</span>'.
                    '</div>'.
                    '<div class="pl-post-content">'.
                    '<p>'.Html::encode($value->content).'</p>'.
                    '</div>'.
                    '<div class="ops"><a href="" class="comment-up" data-id="'.$value->id.'"><i class="glyphicon glyphicon-thumbs-up"></i> (<span>'.$value->up.'</span>)</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="comment-down" data-id="'.$value->id.'"><i class="glyphicon glyphicon-thumbs-down"></i> (<span>'.$value->down.'</span>)</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="comment-reply" data-id="'.$value->id.'" data-postid="'.$id.'" title="回复"><i class="glyphicon glyphicon-share-alt"></i></a></div>'.
                    '</div>'.
                    renderItems($items,$value,$id);
                '</li>';
			}
		}
	}
}
echo '<div class="pllist"><ul class="pl-comment-list">';
echo Comments($comments,$pages,$id);
echo '</ul>';
if ($pages->totalCount>$pages->pageSize){
	echo LinkPager::widget([
		'pagination' => $pages,
	]);
}
echo '</div>';
$this->registerJs('
jQuery(".pl-comment-list").on("click", ".comment-up", function (e) {
	if ($.cookie("comment-"+$(this).data("id"))!=1) {
		$.get("'.Url::to(['post/commentup']).'?id="+$(this).data("id"));
		$(this).children("span").text(parseInt($(this).children("span").text())+1);
		$.cookie("comment-"+$(this).data("id"), "1");
		$(this).parent("div").css("position", "relative");
		$(this).after("<span style=\"position:absolute;color:red;\">+1</span>").next().animate({bottom:"19px"}).fadeOut(900);
	}else{
		alert("你已经投过票了！");
	}
    return false; 
});
jQuery(".pl-comment-list").on("click", ".comment-down", function (e) {
	if ($.cookie("comment-"+$(this).data("id"))!=1) {
		$.get("'.Url::to(['post/commentdown']).'?id="+$(this).data("id"));
		$(this).children("span").text(parseInt($(this).children("span").text())+1);
		$.cookie("comment-"+$(this).data("id"), "1");
		$(this).parent("div").css("position", "relative");
		$(this).after("<span style=\"position:absolute;color:red;\">+1</span>").next().animate({bottom:"19px"}).fadeOut(900);
	}
    return false; 
});
jQuery(".pl-comment-list").on("click", ".comment-reply", function (e) {
	var parentIdHtml="<input type=\"hidden\" id=\"comment-parent_id\" name=\"Comment[parent_id]\" value=\""+$(this).data("id")+"\">";
	if ($(".pl-comment-list form")) {
		$(".pl-comment-list form").remove();
	}
	$(this).parent("div").after($(".out").html());
	$(".pl-comment-list form").append(parentIdHtml);
    return false; 
});
jQuery("#top_reply").on("click", ".pagination li > a", function (e) {
	$.get($(this).attr("href").replace("view","commentpage"), function(result){
		$(".pllist").html(result);
	});
    return false; 
});
$(".pl-comment-list").on("submit", ".pl-post form", function (e) {
    var myform = $(this);
    //jQuery(".btn_fb").button("loading");
    jQuery.ajax({
        url: "'. Url::toRoute(['post/commentajax', 'id' => $id]) .'",
        type: "POST",
        dataType: "json",
        data: myform.serialize(),
        success: function(response) {
            myform.before(response);
            myform.remove();
            jQuery(".btn_fb").button("reset");
            return false;
        },
        error: function(response) {
            jQuery(".btn_fb").button("reset");
            return false;
        }
    });
    return false;
});
');
?>
