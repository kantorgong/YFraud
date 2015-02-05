<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-1
 * Time: 下午4:49
 */

namespace app\modules\admin\components;


class Controller extends \app\components\web\Controller
{
    protected  $_viewPaht;

    public $layout = 'main';


    public function getViewPath() {

        if($this->_viewPaht == null)
            return parent::getViewPath();

        return $this->_viewPaht;
    }

    public function setViewPath($path) {
        $this->_viewPaht = $path;
    }

} 