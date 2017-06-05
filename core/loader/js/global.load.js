function ssbMySQLExecQuery(ssbMySQLQueryStr) {
    $.ajax({
        type: "GET",
        url: ssbPHPLoader,
        data: {
            load: "mysql",
            qustr: ssbMySQLQueryStr
        },
        success: function(ssbDataReturn) {
            return ssbDataReturn;
        }
    });
} // ~ssbMySQLExecQuery()

function ssbGetSessionData(ssbSessionName, ssbSessionData=false, ssbSessionNewData=false) {
    $.ajax({
        type: "GET",
        url: ssbPHPLoader,
        data: {
            load: "session",
            sname: ssbSessionName,
            sdata: ssbSessionData,
            snew: ssbSessionNewData
        },
        success: function(ssbDataReturn) {
            return ssbDataReturn;
        }
    });
} // ~ssbGetSessionData()