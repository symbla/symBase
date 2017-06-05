
// init.ui.js
// This file enables special ".ssbPanel"-Containers to work like lobipanels

function ssbCheckAppState(ssb_AppInstanceTitle) {

    //alert(Storage.getObj("ssb..apps." + ssb_AppInstanceTitle));

} // ~ssbCheckAppState()

function ssbSaveAppState(ssb_AppInstanceTitle, ssb_AppInstanceIcon, ssb_AppInstanceUrl, ssb_AppInstanceSize, ssb_AppInstancePosition) {

    var ssbAppStorageObject = { size: ssb_AppInstanceSize, ssb_AppInstanceIcon, ssb_AppInstanceUrl, position: ssb_AppInstancePosition };
    //Storage.setObj("ssb.julianbaumueller.apps." + ssb_AppInstanceTitle, JSON.stringify(ssbAppStorageObject));

} // ~ssbSaveAppState()