<script type="text/javascript">
	ssbLogin.init();
</script>

<div id="ssbLPMainboxBG"></div>
<div id="ssbLPMainbox">

    <img src="./core/img/logo/symbla_logo.png" />

    <div class="panel panel-default">

        <div class="panel-heading">
            <?php
                echo SSB_LPANEL_WELCOME;
            ?>
        </div>

        <div class="panel-body">

            <form class="ssbFormLP" method="post">

                <div class="input-group">
                    <span class="input-group-addon" id="ssbLoginIconUser"><i class="fa fa-user"></i></span>
                    <input type="text" id="ssbFormLPUID" name="ssbFormLPUID" class="form-control" pattern=".{4,}" placeholder="<?php echo SSB_LPANEL_USER_VALUE; ?>" required autofocus />
                </div>

                <div class="input-group">
                    <span class="input-group-addon" id="ssbLoginIconPass"><i class="fa fa-key"></i></span>
                    <input type="password" id="ssbFormLPPass" name="ssbFormLPPass" class="form-control" placeholder="<?php echo SSB_LPANEL_PASS_VALUE; ?>" required />
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="ssbLPCheckShowPass">
						<?php echo SSB_LPANEL_SHOW_PASS; ?>
                    </label>
                </div>

        </div>

        <div class="panel-footer">

                <button class="btn btn-primary btn-block" id="ssbFormLPSubmit" name="ssbFormLPSubmit" type="submit"><i class="fa fa-unlock"></i> <?php echo SSB_LPANEL_SUBMIT_VALUE; ?></button>
            </form>

        </div>
    </div>
</div>

<div id="ssbDivLoginCR">
	<p><i class="fa fa-copyright"></i> <?php echo \SymBase::today("Y") . ". " . SSB_LPANEL_ALL_RIGHTS_RESERVED; ?></p>
</div>