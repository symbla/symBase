<?php

	/*
	 * Sessions
	 */
	@define(SSB_UDATA, $_SESSION["ssb_udata"]);
	@define(SSB_VIEW, $_SESSION["ssb_view"]);

	/*
	 * Constants for filesystem
	 */
	@define(SSB_CFGDIR, "./config");
	@define(SSB_LOGDIR, "./core/log");
	@define(SSB_CFGFILE, "/lclcfg.ssb");

	/*
	 * Constants for exception handling
	 */
	@define(SSB_LOG_FAIL, 1);
	@define(SSB_LOG_WARN, 2);
	@define(SSB_LOG_INFO, 3);

	/*
	 * Constants for views
	 */
	@define(SSB_VIEW_DASH, 1);
	@define(SSB_VIEW_APP, 2);
	@define(SSB_VIEW_LOGIN, 3);

	/*
	 * Constants for authentication
	 */
	@define(SSB_AUTH_LCL, 0);
	@define(SSB_AUTH_MYSQL, 1);
	@define(SSB_AUTH_GIT, 2);
	@define(SSB_AUTH_FTP, 3);
	@define(SSB_AUTH_SSH, 4);

	/*
	 * Constants for user information
	 */
	@define(SSB_USER_AGENT, $_SERVER["HTTP_USER_AGENT"]);
	@define(SSB_USER_IP, $_SERVER["REMOTE_ADDR"]);
	@define(SSB_ACCEPT_LANGUAGE, $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
	@define(SSB_REQUEST_TIME, $_SERVER["REQUEST_TIME"]);

?>