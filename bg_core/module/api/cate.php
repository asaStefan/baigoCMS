<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if(!defined("IN_BAIGO")) {
	exit("Access Denied");
}

include_once(BG_PATH_INC . "common_api.inc.php"); //验证是否已登录
include_once(BG_PATH_CONTROL_API . "cate.class.php"); //载入商家控制器

$api_cate = new API_CATE();

switch ($GLOBALS["act_get"]) {
	case "get":
		$api_cate->api_get();
	break;

	default:
		$api_cate->api_list();
	break;
}
