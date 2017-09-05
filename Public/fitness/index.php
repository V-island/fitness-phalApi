<?php
/**
 * Fitness 统一入口
 */

require_once dirname(__FILE__) . '/../init.php';

//装载你的接口
DI()->loader->addDirs('Fitness');
DI()->wechatMini = new WechatMini_Lite();

/** ---------------- 响应接口请求 ---------------- **/

$api = new PhalApi();
$rs = $api->response();
$rs->output();
