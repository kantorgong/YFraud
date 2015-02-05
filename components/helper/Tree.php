<?php
/**
 * 通用的树型类.
 * User: 吴涛
 * Date: 14-2-24
 * Time: 下午4:53
 */

namespace app\components\helper;


class Tree {
    private static $_instance = null;

    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    public $arr;

    /**
     * 生成树型结构所需修饰符号，可以换成图片
     * @var array
     */
    public $icon = array('│', '├', '└');
    public $nbsp = "&nbsp;";

    /**
     * 树地图
     * @var array
     */
    private $maps;

    /**
     * @access private
     */
    public $ret = '';

    /**
     * 初始化
     * @return Tree
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 构造函数，初始化类
     * @param array $data 2维数组，例如：
     * array(
     *      1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
     *      2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
     *      3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
     *      4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
     *      5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
     *      6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
     *      7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二')
     * )
     * @return HTree
     */
    public function __construct($data = array()) {
        $this->setData($data);
    }

    /**
     * 设置树数据
     * @param array $data
     * @return Tree
     */
    public function setData($data) {
        foreach ($data as $v) {
            $this->arr[$v['id']] = $v;
            $this->maps[$v['parentid']][] = $v['id'];
        }
        return $this;
    }

    /**
     * 获取分类树
     * @param  $id 父ID
     * @param integer $mx_depth 获取深度 0 所有
     * @param boolean $returnPlane 返回平面数据
     * @param string $childrenName 子菜单KEY
     * @param integer $depth 深度内部使用
     * @return array
     */
    public function getTree($id = 0, $mx_depth = 0, $returnPlane = FALSE, $childrenName='children',$depth = -1) {
        $depth++;
        $mx_depth = ($mx_depth == 0) ? count($this->maps) : $mx_depth;
        $sections = array();
        if ($mx_depth > $depth && isset($this->maps[$id])) {
            $count = count($this->maps[$id]) - 1;
            foreach ($this->maps[$id] as $key => $childId) {

                $child = $this->arr[$childId];
                $child['first'] = $key == 0;
                $child['last'] = $key == $count;
                $child['depth'] = $depth;
                if ($returnPlane) {

                    if (isset($this->maps[$childId])) {
                        $child['ischildren'] = true;
                    };
                    $sections[] = $child;
                    $sections = array_merge($sections, $this->getTree($childId, $mx_depth, $returnPlane,$childrenName, $depth));
                } else {
                    if (isset($this->maps[$childId])) {
                        $child['ischildren'] = true;
                        $child[$childrenName] = $this->getTree($childId, $mx_depth, $returnPlane, $childrenName,$depth);
                    }
                    $sections[] = $child;
                }
            }
        }
        return $sections;
    }

    /**
     * 获取子级子级ID
     * @param type $id 树id
     * @param type $mx_depth 深度默认0 最大深度
     * @param type $inSelf 是否包含自己
     * @param type $depth 内部参数禁止赋值
     * @return array ids
     */
    public function getChildIds($id = 0, $mx_depth = 0, $inSelf = true, $depth = -1) {
        $depth++;
        $mx_depth = ($mx_depth == 0) ? count($this->maps) : $mx_depth;
        $sections = array();
        if ($inSelf)
            $sections[] = $id;
        if ($mx_depth > $depth && isset($this->maps[$id])) {
            foreach ($this->maps[$id] as $childId) {
                $sections = array_merge($sections, $this->getChildIds($childId, $mx_depth, true, $depth));
            }
        }
        return $sections;
    }

    public function getPids($id) {
        $sections = array();
        if(isset($this->arr[$id]) && $this->arr[$id]['parentid'] != 0) {
            $arr = $this->arr[$this->arr[$id]['parentid']];
            $sections[] = $arr['id'];
            if(isset($this->arr[$arr['parentid']])) {
                $sections[] = array_merge($sections, $this->getPids($arr['parentid']));
            }
        }
        return $sections;
    }

    /**
     * 得到子级数组
     * @param int
     * @return array
     */
    public function get_child($myid) {
        $a = $newarr = array();

        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['parentid'] == $myid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }

    /**
     * 得到树型结构
     * @param int ID，表示获得这个ID下的所有子级
     * @param string 生成树型结构的基本代码，例如："<option value=\$id \$selected>\$spacer\$name</option>"
     * @param int 被选中的ID，比如在做树型下拉框的时候需要用到
     * @return string
     */
    public function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '') {
        $number = 1;
        $child = $this->get_child($myid);

        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $a) {
                $j = $k = '';
                if ($number == $total) {
                    $j .= $this->icon[2];
                } else {
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $spacer = $adds ? $adds . $j : '';
                $selected = $id == $sid ? 'selected' : '';
                @extract($a);

                $parentid == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
                $this->ret .= $nstr;
                $nbsp = $this->nbsp;

                $this->get_tree($id, $str, $sid, $adds . $k . $nbsp, $str_group);
                $number++;
            }
        }
        return $this->ret;
    }
} 