<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-5-10
 * Time: 上午9:53
 */

namespace app\components\form;


use yii\helpers\Html;
use yii\widgets\InputWidget;

class FileInputImage extends InputWidget
{
    public $width = "200px";
    public $height = "150px";
    public $image;
    public $baseUrl;

    public function run()
    {

        $html = '<div class="fileinput '.(empty($this->model->{$this->attribute})?'fileinput-new':'').'" style="display: block" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                             style="width: '.$this->width.'; height: '.$this->height.'">';
        if(!empty($this->model->{$this->attribute}) && is_string($this->model->{$this->attribute})) {

                $html .= '<img src="'.$this->baseUrl.'/'.$this->model->{$this->attribute}.'">';
                $html .= Html::activeHiddenInput($this->model,$this->attribute);

        } else {
            if($this->image) {
                $html .= '<img src="'.$this->baseUrl.'/'.$this->image.'">';
                $html .= Html::activeHiddenInput($this->model,$this->attribute,['value'=>$this->image]);
            }
        }
        $html .='</div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">选择</span><span
                                    class="fileinput-exists">更换</span>
                                    ';
        $html .= Html::activeInput('file',$this->model,$this->attribute);
        $html .= '
                                    </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">删除</a>
                        </div>
                    </div>';
        echo $html;
    }
} 