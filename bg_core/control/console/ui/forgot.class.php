<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if (!defined("IN_BAIGO")) {
    exit("Access Denied");
}


/*-------------登录控制器-------------*/
class CONTROL_CONSOLE_UI_FORGOT {

    private $group_allow    = array();
    private $is_super       = false;

    function __construct() { //构造函数
        $this->obj_console  = new CLASS_CONSOLE();
        $this->obj_console->chk_install();

        $this->obj_tpl      = $this->obj_console->obj_tpl;

        $this->obj_sso      = new CLASS_SSO(); //SSO
        $this->mdl_admin    = new MODEL_ADMIN(); //设置管理员模型
    }


    function ctrl_step_2() {
        $_str_adminName = fn_getSafe(fn_get("admin_name"), "txt", "");

        if (fn_isEmpty($_str_adminName)) {
            $_arr_tplData = array(
                "rcode"     => "x010201",
            );
            $this->obj_tpl->tplDisplay("forgot_1", $_arr_tplData);
        }

        $_arr_ssoUser = $this->obj_sso->sso_user_read($_str_adminName, "user_name"); //sso验证
        if ($_arr_ssoUser["rcode"] != "y010102") {
            $this->obj_tpl->tplDisplay("forgot_1", $_arr_ssoUser);
        }

        if ($_arr_ssoUser["user_status"] == "disable") {
            $_arr_tplData = array(
                "rcode"     => "x010401",
            );
            $this->obj_tpl->tplDisplay("forgot_1", $_arr_tplData);
        }

        $_arr_adminRow = $this->mdl_admin->mdl_read($_arr_ssoUser["user_id"]);
        if ($_arr_adminRow["rcode"] != "y020102") {
            $this->obj_tpl->tplDisplay("forgot_1", $_arr_adminRow);
        }

        if ($_arr_adminRow["admin_status"] == "disable") {
            $_arr_tplData = array(
                "rcode"     => "x020402",
            );
            $this->obj_tpl->tplDisplay("forgot_1", $_arr_tplData);
        }

        if (!isset($_arr_ssoUser["user_mail"]) && fn_isEmpty($_arr_ssoUser["user_mail"]) && !isset($_arr_ssoUser["user_sec_ques_1"]) && fn_isEmpty($_arr_ssoUser["user_sec_ques_1"])) {
            $_arr_tplData = array(
                "rcode"     => "x010240",
            );
            $this->obj_tpl->tplDisplay("forgot_1", $_arr_tplData);
        }

        $_arr_tplData = array(
            "userRow"  => $_arr_ssoUser,
        );

        $this->obj_tpl->tplDisplay("forgot_2", $_arr_tplData);
    }


    function ctrl_step_1() {
        $this->obj_tpl->tplDisplay("forgot_1");
    }
}
