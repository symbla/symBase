<script type="text/javascript">
    ssbDash.init();
</script>

<?php
    $ssb_Dash = new \SYMBASE\BIN\Dash();
    $ssb_UAData = $ssb_Dash->getClientInfo();
?>

<div class="container-fluid scrollable" id="ssbDashBoard">
    <div class="row ssbDashRow">
        <div class="ssbDashElement hidden-xs hidden-sm hidden-md col-lg-2">
            <div class="panel" id="ssbDashClock">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h5><i class="fa fa-clock-o"></i> <?php echo SSB_DASH_TIME_HEADER; ?></h5>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="ssbDCSeconds">
                        <div id="ssbDCSecondsBar"></div>
                    </div>
                    <div id="ssbDCTime"></div>
                </div>
            </div>
            <div class="panel" id="ssbDashClientInfo">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h5><i class="fa fa-desktop"></i> <?php echo SSB_DASH_CLIENTINFO_HEADER; ?></h5>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                        echo "<span><i class=\"fa fa-" . strtolower($ssb_UAData["OS"]["icon"]) . "\"></i></span><span class=\"text\">" . $ssb_UAData["OS"]["name"] . " (" . $ssb_UAData["OS"]["bit"] . " Bit)</span>";
                        echo "<hr />";
                        echo "<span><i class=\"fa fa-" . $ssb_UAData["browser"]["icon"] . "\"></i></span><span class=\"text\">" . $ssb_UAData["browser"]["name"] . " (Version " . $ssb_UAData["browser"]["version"] . ")</span>";
                        echo "<hr />";
                        echo "<span><i class=\"fa fa-globe\"></i></span><span class=\"text\">" . SSB_USER_IP . "</span>";
                    ?>
                </div>
            </div>
        </div>

        <div class="ssbDashElement col-xs-12 col-sm-9 col-md-9 col-lg-7">

            <div class="panel" id="ssbAppExplorer">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h5><i class="fa fa-folder-open"></i> <?php echo SSB_DASH_FILES_HEADER; ?></h5>
                    </div>
                </div>
                <div class="panel-body">

                    <!--<ol id="ssbAEDirBCPath" class="breadcrumb"></ol>-->

                    <!-- File search
                    <form class="form-inline">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" class="form-control form-block" placeholder="<?php echo SSB_APP_EXPLORER_SEARCH_PH; ?>" />
                        </div>
                    </form>
                     END OF File search -->

                    <div id="ssbAEBCWrapper">
                        <div id="ssbAEDirBCPath" class="breadcrumb"></div>
                    </div>

                    <table id="ssbAEDirContent" class="table table-striped">
                        <thead class="thead">
                        <tr>
                            <th></th>
                            <th><?php echo SSB_APP_EXPLORER_NAME; ?></th>
                            <th><?php echo SSB_APP_EXPLORER_SIZE; ?></th>
                            <th><?php echo SSB_APP_EXPLORER_LMOD; ?></th>
                        </tr>
                        <tr id="ssbAENewElement">
                            <form class="form-inline" method="post">
                                <th>
                                    <select class="form-control" id="ssbAENewElementTypeSelect">
                                        <option><?php echo SSB_APP_EXPLORER_NEW_FILE; ?></option>
                                        <option><?php echo SSB_APP_EXPLORER_NEW_FOLDER; ?></option>
                                    </select>
                                </th>
                                <th>
                                    <input type="text" class="form-control" id="ssbAENewElementName" placeholder="<?php echo SSB_APP_EXPLORER_NE_TITLE; ?>" />
                                </th>
                                <th>
                                    <button type="submit" class="btn btn-primary" id="ssbAENewElementSubmit"><?php echo SSB_APP_EXPLORER_NE_SUBMIT; ?></button>
                                </th>
                            </form>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

        <div class="ssbDashElement hidden-xs col-sm-3" id="ssbGlobNotificationCenter">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h5><i class="fa fa-bullhorn"></i> <?php echo SSB_DASH_NOTIFY_CENTER; ?></h5>
                    </div>
                </div>
                <div class="panel-body" id="ssbGlobNotifyContainer">
                </div>
            </div>
        </div>

        <!-- Add the extra clearfix for only the required viewport -->
        <div class="ssbDashElement clearfix visible-xs-block"></div>

    </div>
</div>