<?php
/**
 * GRID动作字段.
 * User: Administrator
 * Date: 14-2-24
 * Time: 下午4:05
 */

namespace app\modules\admin\components\grid;

use Yii;
use Closure;
use yii\helpers\Html;

class FrontActionColumn extends \yii\grid\ActionColumn
{
    public $template = "{update} {delete}";

    public $headerOptions = [
        'style' => 'text-align: center; width:150px;'
    ];

    public $contentOptions = [
        'style' => 'text-align: center;'
    ];
    /**
     * Initializes the default button rendering callbacks
     */
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 查看', $url, [
                    'title' => Yii::t('yii', 'View'),
                    'style' => 'padding:0px 2px;white-space:nowrap; '
                ]);
            };
        }
//        if (!isset($this->buttons['update'])) {
//            $this->buttons['update'] = function ($url, $model) {
//                return Html::a('<span class="glyphicon glyphicon-pencil"></span> 修改', $url, [
//                    'title' => Yii::t('yii', 'Update'),
//                    'style' => 'padding:0px 2px;white-space:nowrap; ',
//                    'class'=>'update-action-btn'
//                ]);
//            };
//        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span> 删除', $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', '确定删除这条数据?'),
                    'data-method' => 'post',
                    'style' => 'padding:0px 2px;white-space:nowrap; '
                ]);
            };
        }
    }
} 