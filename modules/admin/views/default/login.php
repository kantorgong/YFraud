<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \backend\models\form $model
 */
$this->title = '管理平台登陆';

?>
<div class="col-sm-10 col-sm-offset-1">
    <div class="login-container">
        <div class="center" style="display: none">
            <h1>
                <i class="icon-leaf green"></i>
                <span class="red">Ace</span>
                <span class="white">Application</span>
            </h1>
            <h4 class="blue">&copy; </h4>
        </div>

        <div class="space-6"></div>

        <div class="position-relative">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div id="login-box" class="login-box visible widget-box no-border">
                <div class="widget-body">
                    <div class="widget-main">
                        <h4 class="header blue lighter bigger">
                            <i class="icon-coffee green"></i>
                            登录
                        </h4>

                        <div class="space-6"></div>
                        <form>
                            <fieldset>
                                <label class="block clearfix">
														<span class="block input-icon input-icon-right">
                                                            <?= $form->field($model, 'username') ?>
                                                            <i class="icon-user"></i>
														</span>
                                </label>

                                <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<?= $form->field($model, 'password')->passwordInput() ?>
                                                            <i class="icon-lock"></i>
														</span>
                                </label>

                                <div class="space"></div>

                                <div class="clearfix">
                                    <label class="inline">
                                        <input type="checkbox" class="ace"/>
                                        <span class="lbl"> Remember Me</span>
                                    </label>


                                    <?= Html::submitButton('登陆', ['class' => 'width-35 pull-right btn btn-sm btn-primary']) ?>
                                </div>
                                <div class="space-4"></div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- /widget-body -->
                </div>
                <!-- /login-box -->

            </div>
            <?php ActiveForm::end(); ?>
            <!-- /position-relative -->
        </div>
    </div>
    <!-- /.col -->
    <script type="text/javascript">
        function show_box(id) {
            jQuery('.widget-box.visible').removeClass('visible');
            jQuery('#' + id).addClass('visible');
        }
    </script>