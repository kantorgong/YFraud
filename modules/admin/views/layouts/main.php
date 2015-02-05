<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\views\AdminAsset;
use yii\widgets\Breadcrumbs;
/**
 * @var \yii\web\View $this
 * @var string $content
 */
AdminAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
	<head>
		<meta charset="<?= Yii::$app->charset; ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>信息管理平台</title>
		<!--[if lt IE 9]>
			<script src="<?= Yii::getAlias('@web') ?>/5555static/js/ie/respond.min.js"></script>
			<script src="<?= Yii::getAlias('@web') ?>/static/js/ie/html5.js"></script>
			<script src="<?= Yii::getAlias('@web') ?>/static/js/ie/excanvas.js"></script>
		  <![endif]-->
		<?php $this->head(); ?>
	</head>

    <body>
    <div class="main-container">
		<?php $this->beginBody(); ?>
    <?= $content ?>
        <?php $this->endBody(); ?>
    </div>
	</body>
</html>
<?php $this->endPage(); ?>
