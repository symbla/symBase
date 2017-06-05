<?php

    /*
     * English language constants
     */

    include(__DIR__ . "/dash/en.dash.lang.php");

    // SYSTEM
    @define(SSB_DATE_FORMAT, "m/d/Y");

    // GLOBAL
    @define(SSB_GLOBAL_CANCEL, "Cancel");
    @define(SSB_GLOBAL_YES, "Yes");
    @define(SSB_GLOBAL_NO, "No");
    @define(SSB_GLOBAL_CLOSE, "Close");

    // CONTEXT
        // APP CONTEXT
        @define(SSB_CONTEXT_APP_CLOSE, "Close window");
        @define(SSB_CONTEXT_APP_MAXIMIZE, "Maximize");
        @define(SSB_CONTEXT_APP_MINIMIZE, "Minimize");
        @define(SSB_CONTEXT_APP_RELOAD, "Reload");

    // Login Panel
    @define(SSB_LPANEL_WELCOME, "Welcome to symbla symBase.<br />Please sign in.");
    @define(SSB_LPANEL_USER_VALUE, "User");
    @define(SSB_LPANEL_PASS_VALUE, "Password");
	@define(SSB_LPANEL_SHOW_PASS, "Show password");
    @define(SSB_LPANEL_SUBMIT_VALUE, "Sign In");
	@define(SSB_LPANEL_ALL_RIGHTS_RESERVED, "All rights reserved.");
    @define(SSB_LPANEL_USER_NOT_EXISTS, "The user does not exist.");
    @define(SSB_LPANEL_WRONG_PASS, "You entered the an invalid password. Please try again.");
    @define(SSB_LPANEL_LOGIN_GOOD, "Login successful. You will be redirected in 3 seconds...");
    @define(SSB_LPANEL_LOGOUT_GOOD, "You have successfully logged out. Please wait 3 seconds...");
	@define(SSB_LPANEL_EMPTY_FIELD, "Please fill in all fields.");

    // Content element "header"
    @define(SSB_HEADER_PERSONAL_DATA, "Personal Data");
    @define(SSB_HEADER_SETTINGS, "Settings");
    @define(SSB_HEADER_LOGOUT, "Sign Out");
    @define(SSB_HEADER_LOGOUT_QUESTION, "Are you sure you want to sign out?");
    @define(SSB_HEADER_ALL_APPS, "My Apps");
    @define(SSB_HEADER_ACTIVE_APPS, "Background Applications");
    @define(SSB_HEADER_USERS, "Users");
    @define(SSB_HEADER_SYSTEM_SETTINGS, "System settings");

    // Apps
    @define(SSB_APP_RUN_XML_ERROR, "The application could not be started because the meta information could not be read.");
    @define(SSB_APP_NOT_EXISTS, "The application does not exist.");
    @define(SSB_APP_LANDING_NOT_EXISTS, "The landing page of the app was not found.");
    @define(SSB_APP_BAD_PARAM, "The application could no be loaded because of bad parameters.");

    // Loader
    @define(SSB_LOADER_BAD_SQL_QUERY, "SQL query cannot be handled.");
    @define(SSB_LOADER_BAD_SESSION_DATA, "Session data could not be loaded.");

    // Dashboard
    @define(SSB_DASH_FILES_HEADER, "My Files");
    @define(SSB_DASH_TIME_HEADER, "Time");
    @define(SSB_DASH_CLIENTINFO_HEADER, "My System");

    // Directories
    @define(SSB_DIR_NOT_EXISTS, "The directory does not exist.");

    //Files
    @define(SSB_FILE_NOT_EXISTS, "The file does not exist.");
    @define(SSB_FILE_BAD_MODE, "The transferred file flags are invalid.");

?>