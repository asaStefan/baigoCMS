<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if(!defined("IN_BAIGO")) {
	exit("Access Denied");
}

/*-------------------------通用-------------------------*/
return array(
	/*------UI------*/
	"ui" => array(
		"pc"      => "标准", //标准
		"mobile"  => "移动设备", //移动设备
	),

	/*------语言列表------*/
	"lang" => array(
		"zh_CN"   => "简体中文", //简体中文
		"en"      => "English", //英语
	),

	/*------用户组类型------*/
	"group" => array(
		"admin"   => "管理组", //管理组
		"user"    => "用户组", //用户组
	),

	/*------栏目类型------*/
	"cate" => array(
		"normal"  => "普通", //普通
		"single"  => "单页", //单页
		"link"    => "跳转", //跳转至
	),

	/*------调用类型------*/
	"call" => array(
		"article"     => "文章列表", //普通
		"hits_day"    => "日排行",
		"hits_week"   => "周排行",
		"hits_month"  => "月排行",
		"hits_year"   => "年排行",
		"hits_all"    => "总排行",
		"spec"        => "专题列表",
		"cate"        => "栏目列表",
		"tag_list"    => "TAG 列表",
		"tag_rank"    => "TAG 排行",
	),

	/*------是否有图片类型------*/
	"callAttach" => array(
		"all"     => "全部", //普通
		"attach"  => "仅显示带附件文章", //单页
		"none"    => "仅显示无附件文章", //跳转至
	),

	"callFile" => array(
		"html"    => "HTML",
		"js"      => "JS",
		"xml"     => "XML",
		"json"    => "JSON",
	),

	/*------缩略图------*/
	"thumb" => array(
		"ratio"   => "比例", //按比例
		"cut"     => "裁切", //裁切
	),
);
