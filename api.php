<?php
/**
 * 微信消息接口URL
 */
defined('BASEDIR') || define('BASEDIR', dirname (__FILE__));
require 'lib/common.func.php';//常用函数
require 'lib/defaultweixin.php';//微信消息响应类
$weixin = new DefaultWeixin();
$weixin->run();
exit(0);
