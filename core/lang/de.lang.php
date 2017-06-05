<?php

    /*
     * German language constants
     */

    include(__DIR__ . "/dash/de.dash.lang.php");

    // SYSTEM
    @define(SSB_DATE_FORMAT, "d.m.Y");

    // GLOBAL
    @define(SSB_GLOBAL_CANCEL, "Abbrechen");
    @define(SSB_GLOBAL_YES, "Ja");
    @define(SSB_GLOBAL_NO, "Nein");
    @define(SSB_GLOBAL_CLOSE, "Schließen");

    // CONTEXT
        // APP CONTEXT
        @define(SSB_CONTEXT_APP_CLOSE, "Fenster schließen");
        @define(SSB_CONTEXT_APP_MAXIMIZE, "Maximieren");
        @define(SSB_CONTEXT_APP_MINIMIZE, "Minimieren");
        @define(SSB_CONTEXT_APP_RELOAD, "Neu laden");

    // Login Panel
    @define(SSB_LPANEL_WELCOME, "Willkommen bei symbla symBase.<br />Bitte melden Sie sich an.");
    @define(SSB_LPANEL_USER_VALUE, "Benutzer");
    @define(SSB_LPANEL_PASS_VALUE, "Passwort");
	@define(SSB_LPANEL_SHOW_PASS, "Passwort anzeigen");
    @define(SSB_LPANEL_SUBMIT_VALUE, "Anmelden");
	@define(SSB_LPANEL_ALL_RIGHTS_RESERVED, "Alle Rechte vorbehalten.");
    @define(SSB_LPANEL_USER_NOT_EXISTS, "Der angegebene Benutzer existiert nicht.");
    @define(SSB_LPANEL_WRONG_PASS, "Sie haben ein falsches Passwort eingegeben. Bitte versuchen Sie es erneut.");
    @define(SSB_LPANEL_LOGIN_GOOD, "Anmeldung erfolgreich. Sie werden in drei Sekunden weitergeleitet. Bitte warten...");
    @define(SSB_LPANEL_LOGOUT_GOOD, "Sie haben sich erfolgreich abgemeldet. Bitte warten Sie 3 Sekunden...");
	@define(SSB_LPANEL_EMPTY_FIELD, "Bitte füllen Sie alle Felder aus.");

    // Content element "header"
    @define(SSB_HEADER_PERSONAL_DATA, "Persönliche Daten");
    @define(SSB_HEADER_SETTINGS, "Einstellungen");
    @define(SSB_HEADER_LOGOUT, "Abmelden");
    @define(SSB_HEADER_LOGOUT_QUESTION, "Sind Sie sicher, dass Sie sich abmelden möchten?");
    @define(SSB_HEADER_ALL_APPS, "Meine Apps");
    @define(SSB_HEADER_ACTIVE_APPS, "Anwendungen im Hintergrund");
    @define(SSB_HEADER_USERS, "Benutzer");
    @define(SSB_HEADER_SYSTEM_SETTINGS, "Systemeinstellungen");

    // Apps
    @define(SSB_APP_RUN_XML_ERROR, "Die Applikation konnten nicht gestartet werden, da die Meta-Informationen nicht gelesen werden konnten.");
    @define(SSB_APP_NOT_EXISTS, "Die Applikation existiert nicht.");
    @define(SSB_APP_LANDING_NOT_EXISTS, "Die Landing-Page der Applikation konnte nicht gefunden werden.");
    @define(SSB_APP_BAD_PARAM, "Die App konnte nicht geladen werden, da falsche Parameter übergeben wurden.");

    // Loader
    @define(SSB_LOADER_BAD_SQL_QUERY, "SQL-Query konnte nicht verarbeitet werden.");
    @define(SSB_LOADER_BAD_SESSION_DATA, "Sitzungsdaten konnten nicht geladen werden.");

    // Dashboard
    @define(SSB_DASH_FILES_HEADER, "Meine Dateien");
    @define(SSB_DASH_TIME_HEADER, "Uhrzeit");
    @define(SSB_DASH_CLIENTINFO_HEADER, "Ihr System");

    // Directories
    @define(SSB_DIR_NOT_EXISTS, "Das Verzeichnis existiert nicht.");

    //Files
    @define(SSB_FILE_NOT_EXISTS, "Die Datei existiert nicht.");
    @define(SSB_FILE_BAD_MODE, "Die übergebenen File-Flags sind ungültig.");

?>