<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Comment;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
$model = new Comment;
?>


<h2 class="pl-title clearfix">
    <i></i>
    <span>文明上网理性发言，请遵守新闻评论服务协议</span>
</h2>
<div class="out">

    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['post/commentajax', 'id' => $id]),
        // 'beforeSubmit' => new \yii\web\JsExpression('function(form) {
        //     //jQuery(".btn_fb").button("loading");
        //     jQuery.ajax({
        //         url: "' . Url::toRoute(['post/commentajax', 'id' => $id]) . '",
        //         type: "POST",
        //         dataType: "json",
        //         data: form.serialize(),
        //         success: function(response) {
        //             if (response!=0) {
        //                 $(".pl-comment-list").prepend(response);
        //             }else{
        //                alert("提交失败");
        //             }
        //             jQuery(".btn_fb").button("reset");
        //             return false;
        //         },
        //         error: function(response) {
        //             jQuery(".btn_fb").button("reset");
        //             return false;
        //         }
        //     });return false;
        //   }')
    ]); ?>
    <div class="pl-reply-box">
        <div class="pl-reply-box-content">
            <?= $form->field($model, 'content')->textarea(['rows' => 6, 'autocomplete' => 'off'])->label(false) ?>
        </div>
        <div class="pl-reply-box-footer">
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <span>登录后才可以评论！请<?= Html::a('登陆', ['/site/login']) ?>或者<?= Html::a('注册', ['/site/signup']) ?></span>
            <?php
            } else {
                ?>
                <?= Html::submitButton('发表', ['class' => 'btn_fb', 'data-loading-text' => "submitting..."]) ?>
            <?php } ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

