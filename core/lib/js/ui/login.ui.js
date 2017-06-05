/*
 * ssbLogin JS Object
 * =======================
 *
 * - "init"	: Initialize login panel
 */

var ssbLogin = {

    init: function() {

        $("<div/>", {
            html: function() {

                $("<p/>", {
                    id: "ssbLPSlogan",
                    html: "symbla &raquo; keep your web in place"

                }).appendTo(this);

            } // ~html
        }).appendTo("#ssbDivLoginCR");

        $("#ssbLPCheckShowPass").change(function () {
            if ($(this).prop("checked"))
                $("#ssbFormLPPass").attr("type", "text");
            else
                $("#ssbFormLPPass").attr("type", "password");
        });

    } // ssbLogin.init()

} // ~ssbLogin