<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-6
 * Time: 下午7:06
 */

namespace app\modules\admin\widget;


use app\components\helper\Tree;
use app\modules\admin\components\User;
use yii\helpers\ArrayHelper;
use Yii;
use yii\base\Widget;

use yii\helpers\Url;
use yii\helpers\Html;

class menu extends \yii\widgets\Menu
{
    public $options = [
        'class' => 'nav nav-list',
    ];

    public $items = [

    ];
    public $submenuTemplate = ' <ul class="submenu">{items}</ul>';

    public function init()
    {
        $this->items = ArrayHelper::merge($this->items, $this->getItems());
    }

    private function getItems()
    {
        $menus = User::getUser()->getMenu();

        foreach ($menus as $k => $v) {
            if($v['display']) {
                unset($menus[$k]);
                continue;
            }
            $menus[$k] = [
                'id' => $v['id'],
                'label' => $v['name'],
                'url' => ($v['controller'] == '#')?'':['/admin/' . $v['controller'] . '/' . $v['action']],
                'icon' => $v['icon'],
                'parentid' => $v['parentid']
            ];

        }

        $menus = Tree::getInstance()->setData($menus)->getTree(0,0,false,'items');

        return $menus;

    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {

            if (!empty($item['items'])) {

                $item['template'] = '<a href="javascript:openapp(\'{url}\',\''.$item['id'].'\',\''.$item['label'].'\')" class="dropdown-toggle">
                        <i class="fa fa-' . $item['icon'] . ' fa-lg"></i>
                        <span  class="menu-text">{label}</span><b class="arrow fa fa-angle-down"></b>
                        </a>';
            } else {
                $item['template'] = '<a href="javascript:openapp(\'{url}\',\''.$item['id'].'\',\''.$item['label'].'\')" ><i class="fa fa-' . (empty($item['icon'])?'leaf':$item['icon']) . '"></i><span  class="menu-text">{label}</span></a>';

            }
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $menu .= strtr($this->submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }
} 