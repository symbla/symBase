/*
 * SymBase.app()
 * =======================
 *
 * - "init"	: Initialize app windows
 * - "run"	: Run Apps
 * - "list"	: Get App Lists
 */

// Get phpLoader
var phpLoader = "./core/loader/php/load.php";

var ssbApp = {

    // Init app functions
    exec: function (action,
                    ssb_AppId,
                    xblnk=0,
                    ssb_AppDisplayName="undefined",
                    ssb_AppIcon="cubes",
                    ssb_AppLoadData={},
                    ssb_AppWinWidth=500,
                    ssb_AppWinHeight=350,
                    ssb_AppWinPosX=100,
                    ssb_AppWinPosY=100) {

        // Switch between actions
        switch (action) {

            case "run":

                //NProgress.start();

                if (document.getElementById(ssb_AppId)) {

                    $("#" + ssb_AppId).lobiPanel("maximize");
                    $("#" + ssb_AppId).lobiPanel("bringToFront");

                    // Let app window blink
                    ssbApp.exec("blink", ssb_AppId);

                } else {

                    $("<div/>", {
                        "class": "panel",
                        "id": ssb_AppId,
                        "style": "display:none;",
                        "html": function() {

                            $("<div/>", {
                                "class": "panel-heading",
                                "style": "display:none;",
                                "html": function() {
                                    $("<div/>", {
                                        "class": "panel-title",
                                        "html": function() {
                                            $("<h5/>", {
                                                "html": function() {
                                                    $("<i/>", {
                                                        "class": "fa fa-" + ssb_AppIcon,
                                                    }).appendTo(this);

                                                    // Append display name
                                                    $(this).append("&nbsp;" + ssb_AppDisplayName);
                                                }
                                            }).appendTo(this)
                                        }
                                    }).appendTo(this)
                                }
                            }).appendTo(this),

                            $("<div/>", {
                                "class": "panel-body",
                                "style": "display:none;"
                            }).appendTo(this)

                        }
                    }).appendTo("#ssbDashBoard");

                    // Initialize new lobipanel
                    ssbApp.exec("init", ssb_AppId);

                    // Load instance into variable
                    ssb_AppInstance = $("#" + ssb_AppId);

                    // Set options for app window
                    ssb_AppInstance.lobiPanel("setSize", ssb_AppWinWidth, ssb_AppWinHeight);
                    ssb_AppInstance.lobiPanel("setPosition", ssb_AppWinPosX, ssb_AppWinPosY);

                    window.console.log("[app:" + ssb_AppId + "] Start running...");

                    // Load data content
                    // ssb_AppWindowFrame.attr("src", "./core/apps/app.inc.php?apptype=" + ssb_AppLoadData.apptype + "&appid=" + ssb_AppLoadData.appid);
                    ssb_AppInstance.lobiPanel("setLoadUrl", "./core/apps/app.inc.php?apptype=" + ssb_AppLoadData.apptype + "&appid=" + ssb_AppLoadData.appid);

                    if(ssb_AppInstance.lobiPanel("load")) {
                        //NProgress.done();
                    } else {
                        //NProgress.done();
                        SymBase.notify("error", [ssb_AppDisplayName, "App konnte nicht geladen werden."], [ssb_AppDisplayName, "App could not be loaded."], ssb_AppIcon);
                    }

                    // Append scrollbars to window
                    ssb_AppInstance.children(".panel-body").perfectScrollbar();

                    // Show app window
                    ssb_AppInstance.fadeIn(0, "linear", function () {
                        ssb_AppInstance.children(".panel-heading").fadeIn(150, "linear");
                        ssb_AppInstance.children(".panel-body").fadeIn(250, "linear");
                        ssb_AppInstance.children(".panel-body").css("height", (ssb_AppWinHeight - 37) + "px");
                    });

                } // ~else

                // Hide app menu
                $("#ssbAppMenu").modal("hide");

                //ssbSaveAppState(ssb_AppTitle, ssb_AppIcon, ssb_AppUrl, ssb_AppInstance.lobiPanel("getSize"), ssb_Appinstance.lobiPanel("getPosition"));
                //ssbCheckAppState(ssb_AppTitle);

                break;

            case "init":

                $("#" + ssb_AppId).lobiPanel({

                    editTitle: false,
                    unpin: false,
                    tooltips: false,
                    toggleIcon: false,
                    resize: "both",
                    minimize: {
                        icon: "fa fa-window-minimize",
                        tooltip: false
                    },
                    expand: {
                        icon: "fa fa-window-maximize",
                        icon2: "fa fa-window-restore",
                        tooltip: false
                    },
                    reload: {
                        icon: "fa fa-refresh",
                        tooltip: false
                    },
                    close: {
                        icon: "fa fa-window-close",
                        tooltip: false
                    },
                    stateful: true,
                    autoload: true,
                    state: "unpinned"

                }, function() {
                    if($(window.width() < 768)) {
                        $(this).toFullScreen();
                        $(this).disableDrag();
                        $(this).disableResize();
                    }
                });

                break;

            case "blink":

                $("#" + ssb_AppId).fadeOut(250, "linear");
                $("#" + ssb_AppId).fadeIn(250, "linear");

                if (xblnk != 1) {
                    xblnk++;
                    ssbApp.exec("blink", ssb_AppId, xblnk);
                } // ~if

                // Stop loading
                NProgress.done();

                break;

            case "list":

                $.ajax({
                    type: "GET",
                    url: phpLoader,
                    data: {
                        load: "applist"
                    },
                    success: function (ssbDataReturn) {

                        // Parse app meta objects
                        var ssbAppsList = $.parseJSON(ssbDataReturn);

                        // Clear app menu
                        $("#ssbAppMenuContent").empty();

                        for (xapp = 0; xapp <= ((ssbAppsList.length) - 1); xapp++) {

                            // Load data attributes
                            if(Cookies.get("ssb_lang") == "de") {
                                var ssbAppDisplayName = ssbAppsList[xapp]["displayname"]["de"];
                            } else {
                                var ssbAppDisplayName = ssbAppsList[xapp]["displayname"]["en"];
                            }

                            $("<button/>", {
                                "type": "button",
                                "class": "btn btn-default",
                                "data-app-title": ssbAppsList[xapp]["title"],
                                "data-app-name": ssbAppDisplayName,
                                "data-app-icon": ssbAppsList[xapp]["icon"],
                                "data-app-view-width": ssbAppsList[xapp]["view"]["width"],
                                "data-app-view-height": ssbAppsList[xapp]["view"]["height"],
                                "data-app-view-posx": ssbAppsList[xapp]["view"]["posx"],
                                "data-app-view-posy": ssbAppsList[xapp]["view"]["posy"],
								"data-app-expandable": ssbAppsList[xapp]["expandable"],
                                "click": function() {
                                    ssbApp.exec(
                                        "run",
                                        $(this).attr("data-app-title"),
                                        0,
                                        $(this).attr("data-app-name"),
                                        $(this).attr("data-app-icon"),
                                        {
                                            apptype: "default",
                                            appid: $(this).attr("data-app-title")
                                        },
                                        $(this).attr("data-app-view-width"),
                                        $(this).attr("data-app-view-height"),
                                        $(this).attr("data-app-view-posx"),
                                        $(this).attr("data-app-view-posy"),
										$(this).attr("data-app-expandable")
                                    );
                                },
                                "html": function() {

                                    $("<span/>", {
                                        "class": "fa fa-" + $(this).attr("data-app-icon") + " fa-3x",
                                        "aria-hidden": "true"
                                    }).appendTo(this),

                                    $("<p/>", {
                                        "html": $(this).attr("data-app-name")
                                    }).appendTo(this);

                                } // ~html
                            }).appendTo("#ssbAppMenuContent");

                        } // ~for

                    }, // ~success
                    error: function() {

                        // Throw notification with error message
                        SymBase.notify("warn", ["Apps fehlgeschlagen", "Apps konnten nicht geladen werden. Bitte versuche es erneut."], ["Listing apps failed", "Getting apps list failed. Please try it again."], "cubes");

                    } // ~error

                }); // ~$.ajax()

                break;

        } // ~switch(action)

    } // ~ssbApp.exec

} // ~ssbApp