<?php $cfg = array(
    "title"          => $this->lang["page"]["opt"] . " &raquo; " . $this->lang["page"]["app"],
    "menu_active"    => "opt",
    "sub_active"     => "app",
    "baigoValidator" => "true",
    "baigoSubmit"    => "true",
    "pathInclude"    => BG_PATH_TPLSYS . "console/default/include/",
);

include($cfg["pathInclude"] . "function.php");
include($cfg["pathInclude"] . "console_head.php"); ?>

    <div class="form-group">
        <ul class="nav nav-pills bg-nav-pills">
            <li>
                <a href="<?php echo BG_URL_CONSOLE; ?>index.php?mod=app&act=list">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <?php echo $this->lang["href"]["back"]; ?>
                </a>
            </li>
        </ul>
    </div>

    <form name="app_form" id="app_form">
        <input type="hidden" name="<?php echo $this->common["tokenRow"]["name_session"]; ?>" value="<?php echo $this->common["tokenRow"]["token"]; ?>">
        <input type="hidden" name="act" id="act" value="reset">
        <input type="hidden" name="app_id" value="<?php echo $this->tplData["appRow"]["app_id"]; ?>">

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["appName"]; ?></label>
                            <div class="form-control-static"><?php echo $this->tplData["appRow"]["app_name"]; ?></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["apiUrl"]; ?></label>
                            <div class="form-control-static"><?php echo BG_SITE_URL . BG_URL_API; ?>api.php</div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["appId"]; ?></label>
                            <div class="form-control-static"><?php echo $this->tplData["appRow"]["app_id"]; ?></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["appKey"]; ?></label>
                            <div class="form-control-static"><?php echo $this->tplData["appRow"]["app_key"]; ?></div>
                        </div>

                        <div class="bg-submit-box"></div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary bg-submit"><?php echo $this->lang["btn"]["resetKey"]; ?></button>
                            <span class="help-block"><?php echo $this->lang["label"]["appKeyNote"]; ?></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["appAllow"]; ?></label>
                            <dl class="bg-dl">
                                <?php foreach ($this->appMod as $key_m=>$value_m) { ?>
                                    <dt><?php echo $value_m["title"]; ?></dt>
                                    <dd>
                                        <ul class="list-inline">
                                            <?php foreach ($value_m["allow"] as $key_s=>$value_s) { ?>
                                                <li>
                                                    <span class="glyphicon glyphicon-<?php if (isset($this->tplData["appRow"]["app_allow"][$key_m][$key_s])) { ?>ok-sign text-success<?php } else { ?>remove-sign text-danger<?php } ?>"></span>
                                                    <?php echo $value_s; ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </dd>
                                <?php } ?>
                            </dl>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["ipAllow"]; ?></label>
                            <div class="form-control-static">
                                <pre><?php echo $this->tplData["appRow"]["app_ip_allow"]; ?></pre>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["ipBad"]; ?></label>
                            <div class="form-control-static">
                                <pre><?php echo $this->tplData["appRow"]["app_ip_bad"]; ?></pre>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang["label"]["note"]; ?></label>
                            <div class="form-control-static"><?php echo $this->tplData["appRow"]["app_note"]; ?></div>
                        </div>

                        <div class="form-group">
                            <a href="<?php echo BG_URL_CONSOLE; ?>index.php?mod=app&act=form&app_id=<?php echo $this->tplData["appRow"]["app_id"]; ?>">
                                <span class="glyphicon glyphicon-edit"></span>
                                <?php echo $this->lang["href"]["edit"]; ?>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="well">
                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang["label"]["id"]; ?></label>
                        <div class="form-control-static"><?php echo $this->tplData["appRow"]["app_id"]; ?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang["label"]["status"]; ?></label>
                        <div class="form-control-static">
                            <?php app_status_process($this->tplData["appRow"]["app_status"], $this->status["app"]); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <a href="<?php echo BG_URL_CONSOLE; ?>index.php?mod=app&act=form&app_id=<?php echo $this->tplData["appRow"]["app_id"]; ?>">
                            <span class="glyphicon glyphicon-edit"></span>
                            <?php echo $this->lang["href"]["edit"]; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>

<?php include($cfg["pathInclude"] . "console_foot.php"); ?>

    <script type="text/javascript">
    var opts_submit_form = {
        ajax_url: "<?php echo BG_URL_CONSOLE; ?>request.php?mod=app",
        confirm: {
            selector: "#act",
            val: "reset",
            msg: "<?php echo $this->lang["confirm"]["resetKey"]; ?>"
        },
        msg_text: {
            submitting: "<?php echo $this->lang["label"]["submitting"]; ?>"
        }
    };

    $(document).ready(function(){
        var obj_submit_form = $("#app_form").baigoSubmit(opts_submit_form);
        $(".bg-submit").click(function(){
            obj_submit_form.formSubmit();
        });
    });
    </script>

<?php include($cfg["pathInclude"] . "html_foot.php"); ?>