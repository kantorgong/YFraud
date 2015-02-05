<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-2-24
 * Time: 上午11:47
 */

namespace app\modules\admin\components\grid;


class GridView extends \yii\grid\GridView {
    public $layout = '{items}<div class="row"><div class="col-xs-6"><div class="dataTables_info">{summary}</div></div><div class="col-xs-6">{pager}</div></div>';
    public $pager = [
        'options' => [
            'class' => 'pagination pagination-sm dataTables_paginate paging_full_numbers '
        ]
    ];

    public $tableOptions = [
        'class' => 'table table-striped table-bordered table-hover'
    ];
} 