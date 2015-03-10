{* admin_auth.tpl 管理员编辑界面 *}
{* 栏目显示函数（递归） *}
{function cate_list arr="" level=""}
	<dl class="list_baigo {if $level > 0}list_padding{/if}">
		{foreach $arr as $value}
			<dt>{$value.cate_name}</dt>
			<dd>
				<label for="cate_{$value.cate_id}" class="checkbox-inline">
					<input type="checkbox" id="cate_{$value.cate_id}" class="chk_all">
					{$lang.label.all}
				</label>
				{foreach $lang.allow as $key_s=>$value_s}
					<label for="cate_{$value.cate_id}_{$key_s}" class="checkbox-inline">
						<input type="checkbox" name="admin_allow_cate[{$value.cate_id}][{$key_s}]" value="1" id="cate_{$value.cate_id}_{$key_s}" class="cate_{$value.cate_id}" group="admin_allow_cate">
						{$value_s}
					</label>
				{/foreach}
				{if $value.cate_childs}
					{cate_list arr=$value.cate_childs level=$value.cate_level}
				{/if}
			</dd>
		{/foreach}
	</dl>
{/function}

{$cfg = [
	title          => "{$adminMod.admin.main.title} - {$lang.page.auth}",
	menu_active    => "admin",
	sub_active     => "auth",
	baigoCheckall  => "true",
	baigoValidator => "true",
	baigoSubmit    => "true",
	str_url        => "{$smarty.const.BG_URL_ADMIN}ctl.php?mod=admin"
]}

{include "include/admin_head.tpl" cfg=$cfg}

	<li><a href="{$smarty.const.BG_URL_ADMIN}ctl.php?mod=admin&act_get=list">{$adminMod.admin.main.title}</a></li>
	<li>{$lang.page.auth}</li>

	{include "include/admin_left.tpl" cfg=$cfg}

	<div class="form-group">
		<ul class="list-inline">
			<li>
				<a href="{$smarty.const.BG_URL_ADMIN}ctl.php?mod=admin&act_get=list">
					<span class="glyphicon glyphicon-chevron-left"></span>
					{$lang.href.back}
				</a>
			</li>
			<li>
				<a href="{$smarty.const.BG_URL_HELP}ctl.php?mod=admin&act_get=admin#auth" target="_blank">
					<span class="glyphicon glyphicon-question-sign"></span>
					{$lang.href.help}
				</a>
			</li>
		</ul>
	</div>

	<form name="admin_form" id="admin_form">
		<input type="hidden" name="token_session" class="token_session" value="{$common.token_session}">
		<input type="hidden" name="act_post" value="auth">

		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<div id="group_admin_name">
								<label for="admin_name" class="control-label">{$lang.label.username}<span id="msg_admin_name">*</span></label>
								<input type="text" name="admin_name" id="admin_name" class="validate form-control">
							</div>
						</div>

						<div class="form-group">
							<div id="group_admin_nick">
								<label for="admin_nick" class="control-label">{$lang.label.nick}<span id="msg_admin_nick"></span></label>
								<input type="text" name="admin_nick" id="admin_nick" class="validate form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">{$lang.label.cateAllow}</label>
							<div class="checkbox_baigo">
								<label for="chk_all">
									<input type="checkbox" id="chk_all" class="first">
									{$lang.label.all}
								</label>
							</div>
							{cate_list arr=$tplData.cateRows}
						</div>

						<div class="form-group">
							<div id="group_admin_note">
								<label for="admin_note" class="control-label">{$lang.label.note}<span id="msg_admin_note"></span></label>
								<input type="text" name="admin_note" id="admin_note" class="validate form-control">
							</div>
						</div>

						<div class="form-group">
							<button type="button" class="go_submit btn btn-primary">{$lang.btn.submit}</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="well">
					<label class="control-label">{$lang.label.status}<span id="msg_admin_status">*</span></label>
					<div class="form-group">
						{foreach $status.admin as $key=>$value}
							<div class="radio_baigo">
								<label for="admin_status_{$key}">
									<input type="radio" name="admin_status" id="admin_status_{$key}" value="{$key}" class="validate" {if $tplData.adminRow.admin_status == $key}checked{/if} group="admin_status">
									{$value}
								</label>
							</div>
						{/foreach}
					</div>

					<label class="control-label">{$lang.label.profileAllow}</label>
					<div class="form-group">
						<div class="checkbox_baigo">
							<label for="admin_allow_profile_info">
								<input type="checkbox" name="admin_allow_profile[info]" id="admin_allow_profile_info" value="1">
								{$lang.label.profileInfo}
							</label>
						</div>
						<div class="checkbox_baigo">
							<label for="admin_allow_profile_pass">
								<input type="checkbox" name="admin_allow_profile[pass]" id="admin_allow_profile_pass" value="1">
								{$lang.label.profilePass}
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form>

{include "include/admin_foot.tpl" cfg=$cfg}

	<script type="text/javascript">
	var opts_validator_form = {
		admin_name: {
			length: { min: 1, max: 0 },
			validate: { type: "ajax", format: "strDigit", group: "group_admin_name" },
			msg: { id: "msg_admin_name", too_short: "{$alert.x020201}", too_long: "{$alert.x020202}", format_err: "{$alert.x020203}", ajaxIng: "{$alert.x030401}", ajax_err: "{$alert.x030402}" },
			ajax: { url: "{$smarty.const.BG_URL_ADMIN}ajax.php?mod=admin&act_get=chkauth", key: "admin_name", type: "str" }
		},
		admin_nick: {
			length: { min: 0, max: 30 },
			validate: { type: "str", format: "text", group: "group_admin_nick" },
			msg: { id: "msg_admin_nick", too_long: "{$alert.x020216}" }
		},
		admin_note: {
			length: { min: 0, max: 30 },
			validate: { type: "str", format: "text", group: "group_admin_note" },
			msg: { id: "msg_admin_note", too_long: "{$alert.x020212}" }
		},
		admin_status: {
			length: { min: 1, max: 0 },
			validate: { type: "radio" },
			msg: { id: "msg_admin_status", too_few: "{$alert.x020213}" }
		}
	};

	var opts_submit_form = {
		ajax_url: "{$smarty.const.BG_URL_ADMIN}ajax.php?mod=admin",
		btn_text: "{$lang.btn.ok}",
		btn_close: "{$lang.btn.close}",
		btn_url: "{$cfg.str_url}"
	};

	$(document).ready(function(){
		var obj_validate_form  = $("#admin_form").baigoValidator(opts_validator_form);
		var obj_submit_form    = $("#admin_form").baigoSubmit(opts_submit_form);
		$(".go_submit").click(function(){
			if (obj_validate_form.validateSubmit()) {
				obj_submit_form.formSubmit();
			}
		});
		$("#admin_form").baigoCheckall();
	})
	</script>

{include "include/html_foot.tpl" cfg=$cfg}
