/*
 * ssbLogin JS Object
 * =======================
 *
 * - "init"	: Initialize login panel
 */

var ssbLogin = {

    init: function() {

        $("#ssbDivLoginCR").append("<p id=\"ssbLPSlogan\">symbla &raquo; keep your web in place</p>");

        $("#ssbLPCheckShowPass").change(function () {
            if ($(this).prop("checked"))
                $("#ssbFormLPPass").attr("type", "text");
            else
                $("#ssbFormLPPass").attr("type", "password");
        });

    } // ssbLogin.init()

} // ~ssbLogin