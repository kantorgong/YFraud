<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\Linkage $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index','LinkageSearch'=>['keyid'=>$model->keyid,'parentid'=>$model->parentid]])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="linkage-form">

                <?php

                $form = ActiveForm::begin(); ?>



                <?= $form->field($model, 'name')->textInput(['maxlength' => 30]) ?>

                <?= $form->field($model, 'listorder')->textInput(['style'=>'width:100px']) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
