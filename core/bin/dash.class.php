<?php
namespace SYMBASE\BIN;

class Dash {

    public function getClientInfo() {

        include("./core/thirdparty/PhpUserAgent/Source/UserAgentParser.php");
        $ssb_UAData = parse_user_agent();

        $ssb_UADataArray = array(
            "OS" => array(
                "name" => $ssb_UAData["platform"],
                "bit" => "",
                "icon" => ""
            ),
            "browser" => array(
                "name" => $ssb_UAData["browser"],
                "version" => $ssb_UAData["version"],
                "icon" => ""
            )
        );

        if($ssb_UAData["platform"] == "iPhone")
            $ssb_UADataArray["OS"]["icon"] = "mobile";
        else
            $ssb_UADataArray["OS"]["icon"] = strtolower($ssb_UAData["platform"]);

        if($ssb_UAData["browser"] == "MSIE")
            $ssb_UADataArray["browser"]["icon"] = "internet-explorer";
        elseif($ssb_UAData["browser"] == "MSEDGE")
            $ssb_UADataArray["browser"]["icon"] = "edge";
        else
            $ssb_UADataArray["browser"]["icon"] = strtolower($ssb_UAData["browser"]);

        if(strstr(SSB_USER_AGENT, "x64") || strstr(SSB_USER_AGENT, "x86_64") || strstr(SSB_USER_AGENT, "WOW64"))
            $ssb_UADataArray["OS"]["bit"] = 64;
        else
            $ssb_UADataArray["OS"]["bit"] = 32;

        return $ssb_UADataArray;

    } # ~getClientInfo

} # ~Dash
?>