<!-- app menu -->
	<div class="modal fade" id="ssbAppMenu" role="dialog" tabindex="-1" aria-labelledby="AlleApps">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-th"></i> <?php echo SSB_HEADER_ALL_APPS; ?></h4>
				</div>
				<div class="modal-body" id="ssbAppMenuContent">
				</div>
                <div class="modal-footer" id="ssbAppMinimizedToolbar">
                    <h5><i class="fa fa-heartbeat">&nbsp;</i><?php echo SSB_HEADER_ACTIVE_APPS; ?></h5>
                </div>
			</div>
		</div>
	</div>
<!-- END OF app menu -->

<!-- header navbar -->
	<nav class="navbar navbar-default navbar-fixed-bottom navbar-inverse" style="background: #333;" id="ssbHeader">
		<div class="container-fluid">

			<div class="navbar-header pull-left">
				<!-- BRAND -->
				<img class="navbar-brand" alt="symbla" src="./core/img/logo/symbla_logo.png">

				<a href="#!" onClick="ssbApp.exec('list')" class="navbar-brand" id="ssbLinkAppMenuLauncher" data-toggle="modal" data-target="#ssbAppMenu" title="<?php echo SSB_HEADER_ALL_APPS; ?>">
					<i class="glyphicon glyphicon-th"></i>
				</a>

			</div>

			<div class="navbar-header pull-right">
				<!-- TOGGLE MENU -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ssbHeaderNavbarCollapse" aria-expanded="false" aria-controls="navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="navbar-collapse collapse" id="ssbHeaderNavbarCollapse">

				<ul class="nav navbar-nav navbar-right">
					<li class="dropup">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="fa fa-user"></span>
							<?php
								echo $_SESSION["ssb_udata"]["ufirst"];
								echo "&nbsp;";
								echo $_SESSION["ssb_udata"]["ulast"];
							?>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-header"><i class="fa fa-user"></i> <b><?php echo $_SESSION["ssb_udata"]["UID"]; ?></b></li>
							<li class="divider"></li>
							<li><a href="#"><i class="fa fa-lock"></i> <?php echo SSB_HEADER_PERSONAL_DATA; ?></a></li>
							<li><a href="#"><i class="fa fa-cog"></i> <?php echo SSB_HEADER_SETTINGS; ?></a></li>
							<li class="divider"></li>
							<li><a href="#"><i class="glyphicon glyphicon-th"></i> Apps</a></li>
							<?php
								if($_SESSION["ssb_udata"]["isadm"]) {
									echo "<li class=\"divider\"></li>\n";
									echo "<li class=\"dropdown-header\">Administration</li>\n";
									echo "<li><a href=\"#\" onClick=\"ssbApp.exec('run', 'ssb_usercontrol', 0, 'Benutzerverwaltung', 'users', {app:'ssb_usercontrol'}, 800, 650)\"><i class=\"fa fa-users\"></i> " . SSB_HEADER_USERS . "</a></li>\n";
									echo "<li><a href=\"#\" onClick=\"ssbApp.exec('run', 'ssb_systemsettings', 0, 'Systemeinstellungen', 'cogs', {app:'ssb_systemsettings'}, 1000, 650)\"><i class=\"fa fa-cogs\"></i> " . SSB_HEADER_SYSTEM_SETTINGS . "</a></li>\n";
								} # ~if
							?>
                            <li><a href="#" onClick='SymBase.notify("error", ["Fehler", "JS-Module konnten nicht geladen werden."], ["Error", "JS modules could not be loaded."], "warning")'>Notification Test</a></li>
						</ul>
					</li>

					<li>
						<a href="#!" data-toggle="modal" data-target="#ssbLogoutDialog"><i class="fa fa-sign-out"></i> <?php echo SSB_HEADER_LOGOUT; ?></a>
					</li>

				</ul> <!-- ~/navbar-right -->
			</div> <!-- ~/navbar-collapse -->
		</div> <!-- ~/container-fluid -->
	</nav>
<!-- END OF navbar -->

<!-- logout dialog -->
	<div class="modal fade" id="ssbLogoutDialog" role="dialog" tabindex="-1" aria-labelledby="LogoutDialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-out"></i> <?php echo SSB_HEADER_LOGOUT; ?></h4>
				</div>
				<div class="modal-body">
					<span><?php echo SSB_HEADER_LOGOUT_QUESTION; ?></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo SSB_GLOBAL_CANCEL; ?></button>
					<button type="button" class="btn btn-primary" onClick="window.location='?logout'"><i class="fa fa-sign-out"></i> <?php echo SSB_HEADER_LOGOUT; ?></button>
				</div>
			</div>
		</div>
	</div>
<!-- END OF logout dialog -->                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      