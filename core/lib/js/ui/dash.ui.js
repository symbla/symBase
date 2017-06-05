/*
 * SymBase.dash()
 * =======================
 *
 * - "init"	: Initialize dashboard
 */

var ssbDash = {

    // Init dashboard
    init: function() {

        $.when(
            // 3rdParty
            //$.getScript("./core/thirdparty/chartjs/src/chart.js"),
            $.getScript("./core/thirdparty/tablesorter/jquery.tablesorter.min.js")

        ).done(function() {
            SymBase.notify("log", ["Dashboard", "3rdParty-Module geladen."], ["Dashboard", "3rdParty modules loaded."]);

        }).fail(function(jqxhr, settings, exception) {
            SymBase.notify("error", ["Dashboard-Module", "3rdParty-Module konnten nicht geladen werden!"], ["Dashboard modules", "Cannot load 3rdParty modules!"], "warning");
            console.log(jqxhr);
            console.log(exception);
        });

        // Read init directory (/)
        ssbFileList.expReadDir('/');

        // Check if there are notifications to show
        if($("#ssbGlobNotifyContainer > .ssbGlobNotify:not('.log')").length == 0) {
            $("#ssbGlobNotificationCenter").fadeOut();
        }

        // Set interval for dashboard listener
        window.setInterval(function () {

            var today = new Date();
            var hour = today.getHours();
            var min = today.getMinutes();
            var sec = today.getSeconds();

            min = ssbCheckTime(min);
            sec = ssbCheckTime(sec);
            s2w = sec * 1.67;

            ssbDCTimeHTML = "<p>" + hour + ":" + min + "</p>";

            $("#ssbDCTime").empty();
            $("#ssbDCTime").append(ssbDCTimeHTML);
            $("#ssbDCSecondsBar").width(s2w + '%');

            if (min % 2 == 0)
                $("#ssbDCSecondsBar").css("float", "left");
            else
                $("#ssbDCSecondsBar").css("float", "right");

            function ssbCheckTime(i) {
                if (i<10) i = "0" + i;
                return i;
            } // ~ssbCheckTime()

        }, 10);


        /*
         Listener for minimized window panel
         */
        $(window).resize(function() {

            if($(window).width() <= 768) {

                // Move minimized panel to app list modal
                $(".lobipanel-minimized-toolbar").appendTo("#ssbAppMinimizedToolbar");

            } else {

                // Move minimized panel to app list modal
                $(".lobipanel-minimized-toolbar").appendTo("body");

            } // ~else

        });

    } // ~init()

} // ~ssbDash()