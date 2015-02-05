<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-1
 * Time: 下午4:51
 */

namespace app\components\web;


class Controller extends \yii\web\Controller {

    /**
    +----------------------------------------------------------
     * 操作错误跳转的快捷方法
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param Boolean $ajax 是否为Ajax方式
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    protected function error($message, $data = null) {
        $this->ajaxReturn($data, $message, 0);
    }

    /**
    +----------------------------------------------------------
     * 操作成功跳转的快捷方法
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param Boolean $ajax 是否为Ajax方式
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    protected function success($message, $data = null) {

        $this->ajaxReturn($data, $message, 1);
    }

    /**
    +----------------------------------------------------------
     * Ajax方式返回数据到客户端
    +----------------------------------------------------------
     * @access protected
    +----------------------------------------------------------
     * @param mixed $data 要返回的数据
     * @param String $info 提示信息
     * @param boolean $status 返回状态
     * @param String $status ajax返回类型 JSON XML
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    protected function ajaxReturn($data, $info = '', $status = 1, $type = 'JSON') {

        $result = array();
        $result['status'] = $status;
        $result['info'] = $info;
        $result['data'] = $data;
        //扩展ajax返回数据, 在Action中定义function ajaxAssign(&$result){} 方法 扩展ajax返回数据。
        if (method_exists($this, 'ajaxAssign'))
            $this->ajaxAssign($result);

        if (strtoupper($type) == 'JSON') {
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:text/html; charset=utf-8');

            exit(json_encode($result));
        } elseif (strtoupper($type) == 'XML') {
            // 返回xml格式数据
            header('Content-Type:text/xml; charset=utf-8');
            exit(xml_encode($result));
        } elseif (strtoupper($type) == 'EVAL') {
            // 返回可执行的js脚本
            header('Content-Type:text/html; charset=utf-8');
            exit($data);
        } else {
            // TODO 增加其它格式
        }
    }
} 