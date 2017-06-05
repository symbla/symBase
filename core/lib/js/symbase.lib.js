/*
    Default JavaScript file
 */

	/*
	 * Load required libraries and initialize SymBase framework
	 */
		
	console.log("                     _     _       \n ___ _   _ _ __ ___ | |__ | | __ _ \n/ __| | | | '_ ` _ \\| '_ \\| |/ _` |\n\\__ \\ |_| | | | | | | |_) | | (_| |\n|___/\\__, |_| |_| |_|_.__/|_|\\__,_|\n     |___/         SymBase      \n\n");

	// Load required libraries
	$.when(

		// 3rdParty libraries
		$.getScript("./core/thirdparty/lobipanel/dist/js/lobipanel.min.js"),
	    $.getScript("./core/thirdparty/js-cookie/js.cookie.js"),
	    $.getScript("./core/thirdparty/perf-sb/js/perfect-scrollbar.jquery.min.js"),
        $.getScript("./core/thirdparty/nprogress/nprogress.js")
	    // $.getScript("./core/thirdparty/html2canvas/build/html2canvas.min.js")
	    
	).done(function() {
	    SymBase.notify("log", ["", "JavaScript-Module geladen."], ["", "JavaScript modules loaded."]);

        $(function() {
            $('.scrollable').perfectScrollbar();
        });
	    
	}).fail(function(jqxhr, settings, exception) {
        SymBase.notify("error", ["Fehler", "JS-Module konnten nicht geladen werden."], ["Error", "JS modules could not be loaded."], "warning");
	    console.log(jqxhr);
	    console.log(exception);
	});
	
	// Set global AJAX properties
	$.ajaxSetup({
		beforeSend: function(jqxhr, object) {
			var progressTimeout = setTimeout('SymBase.notify("info", ["Warten auf Prozess...", "Der Prozess dauert länger als gewöhnlich."], ["Waiting for process...", "The process takes longer than usual."])', 6000);
			NProgress.inc();
			
		}, complete: function() {
			NProgress.done();
			clearTimeout(progressTimeout);
		}
	});


var SymBase = {

	notify: function(notifyMode, notifyMsgDE = Array(), notifyMsgEN = Array(), notifyIcon = "bullhorn") {

	    // Create webkit browser notification
        if(!("Notification" in window)) {
            // No browser support

        } else if(Notification.permission !== "denied") {
            Notification.requestPermission();

        } else if(Notification.permission === "granted") {
            // Permission granted
            if (Cookies.get("ssb_lang") == "de")
                new Notification(notifyMsgDE[0]);

            else
                new Notification(notifyMsgEN[0]);
        }

        // Create unique identifier
        var notifyUID = Math.random().toString(16).slice(2);

        $("<div/>", {
            "class": "ssbGlobNotify " + notifyMode,
            "id": notifyUID,
            "html": function() {

            	// Append notification header
            	$("<div/>", {
            		"id": "ssbGlobNotifyHeader",
            		"html": function() {

            			$("<h5/>", {
            				"html": function() {

								$("<i/>", {
									"class": "fa fa-" + notifyIcon,
									"html": "&nbsp;"
								}).appendTo(this);

                                if(Cookies.get("ssb_lang") == "de")
                                    $(this).append(notifyMsgDE[0]);
                                else
									$(this).append(notifyMsgEN[0]);

                                $("<a/>", {
                                    "html": function() {
                                        $("<i/>", {
                                            "class": "fa fa-close"

                                        }).appendTo(this);
                                    }, // ~html

                                    "click": function() {
                                        $(this).parents(".ssbGlobNotify").remove();

                                    } // ~click
                                }).appendTo(this);

							} // ~html
						}).appendTo(this);

					} // ~html
				}).appendTo(this);

            	// Append notification message
            	$("<p/>", {
                    "html": function() {

                        if(Cookies.get("ssb_lang") == "de") {
                            $(this).append(notifyMsgDE[1]);
                            console.log("[ssb:" + notifyMode + "] " + notifyMsgDE[1]);

                        } else {
							$(this).append(notifyMsgEN[1]);
							console.log("[ssb:" + notifyMode + "] " + notifyMsgDE[1]);

						} // ~else

                    } // ~html
                }).appendTo(this);

                // Hide notification after 3 seconds
                $(this).delay(5000).animate({ "background-color": "#333" }, 2000);

            } // ~html
        }).prependTo("#ssbGlobNotifyContainer");

        // Append scrollbar to notification container
        $("#ssbGlobNotifyContainer").perfectScrollbar();

	} // ~SymBase.notify()
	
} // ~SymBase()