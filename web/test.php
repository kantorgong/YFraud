<?php
$str='中文a字1符';
//计算如下
echo (strlen($str) + mb_strlen($str,'UTF8')) / 2;

?>
