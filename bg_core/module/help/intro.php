<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if(!defined("IN_BAIGO")) {
	exit("Access Denied");
}

include_once(BG_PATH_INC . "common_help.inc.php"); //验证是否已登录
include_once(BG_PATH_CONTROL_HELP . "intro.class.php"); //载入文章类

$ctl_intro = new CONTROL_INTRO();

$ctl_intro->ctl_show($GLOBALS["act_get"]);
