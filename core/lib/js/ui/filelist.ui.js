/*
 * ssbFileList
 * =======================
 *
 * - "expReadDir"       : Read the content of a directory on the local file system
 * - "expRenderDirs"    : Renders folders as list objects
 * - "expRenderFiles"   : Render files as list objects
 * - "expRenderBCPath"  : Render the breadcrumb path above the list
 */

var ssbFileList = {

    /*
        Methods for dashboard file explorer
     */

    // Create unique identifier
    objectUID: Math.random().toString(16).slice(2),

    /*
        Read the content of a directory on the local file system
        @param {strimg} expDirStr Path to destination folder
        @param {string} objType Ident which object type has been clicked (list or breadcrumb)
        @param {string} [sortBy] Define after which column the list is sorted (Name, Size, Last Modified)
        @param {string} [sortType] Defines after which type the list is sorted (ascending or descending)
     */
    expReadDir: function (expDirStr, objType, sortBy = "Name", sortType = "asc") {

        var expDirCurrentPath = $("#ssbAEDirContent").attr("data-current-path");
        var expDirTmpPath = "";

        // Append current folder
        if(typeof(expDirCurrentPath) === "undefined") {
            $("#ssbAEDirContent").attr("data-current-path", '/');
            ssbFileList.expRenderBCPath('/');

            expDirTmpPath = expDirStr;

        } else {

            if (objType == "list") {
                var expDirTmpPath = expDirCurrentPath + expDirStr;

            } else if (objType == "bc") {
                var expDirTmpPath = expDirStr;

            } // ~elseif

        } // ~else

        $.ajax({
            type: "GET",
            url: "./core/loader/php/dash/filelist.load.php",
            data: {
                ssbFileListExpParamDirStr: expDirTmpPath
            },
            success: function (expDataReturn) {

                // Parse data return objects
                var expDirContentObject = jQuery.parseJSON(expDataReturn);

                // Clear directory content list
                $("#ssbAEDirContentList").remove();
                // Create object content list
                $("<tbody/>", {
                    "id": "ssbAEDirContentList"
                }).appendTo("#ssbAEDirContent");

                /*
                    Render files and directories
                 */
                ssbFileList.expRenderDirs(expDirContentObject["dirs"], sortBy, sortType);
                ssbFileList.expRenderFiles(expDirContentObject["files"], sortBy, sortType);

                // Write current folder
                $("#ssbAEDirContent").attr("data-current-path", expDirTmpPath);

                // Refresh breadcrumb path
                ssbFileList.expRenderBCPath(expDirTmpPath);

            }, // ~success
            error: function() {

                // Throw error message
                SymBase.notify("error", ["Fehler beim laden","Beim laden des Ordnerinhaltes ist ein Fehler aufgetreten."], ["Error while loading", "Could not load the content of the directory."], "folder-open")

                // Read directory again
                ssbFileList.expReadDir(expDirTmpPath, "list");

                // Abort request
                this.abort();

            } // ~error

        }); // ~$.ajax()

        // Set timer to frequently reload directories content
        window.setTimeout("ssbFileList.expReadDir(expDirTmpPath, 'list');", 5000);

    }, // ~expReadDir()

    /*
        Renders list objects of directories
        @param {string} dirArray Array which contains data with folders at the given location
        @param {string} [sortBy] Define after which column the directories are sorted (Name, Size, Last Modified)
        @param {string} [sortType] Defines after which type the directories are sorted (ascending or descending)
     */
    expRenderDirs: function(dirArray, sortBy, sortType) {

        // Sort data array
        dirArray.sort();

        /*
            Iteration for rendering directories
         */
        for (var xAEdIter = 0; xAEdIter <= ((dirArray.length) - 1); xAEdIter++) {

            var expCE_DN_Split = dirArray[xAEdIter].split('/');
            var expCE_DisplayName = expCE_DN_Split[(expCE_DN_Split.length) - 1];

            // Open table row tag
            $("<tr/>", {
                "class": "ssbFlDataObject",
                "id": ssbFileList.objectUID,
                "data-type": "folder",
                "data-display-name": expCE_DisplayName,
                "data-full-path": dirArray[xAEdIter],
                "html": function() {

                    $("<td/>", {
                        "class": "ssbFlObjIcon",
                        "html": function() {
                            $("<i/>", {
                                "class": "fa fa-folder fa-2x",
                                "aria-hidden": "true"
                            }).appendTo(this)
                        }
                    }).appendTo(this),

					$("<td/>", {
						"class": "ssbFlObjName",
						"html": function() {
							$("<span/>", {
								"html": expCE_DisplayName
							}).appendTo(this)
						}
					}).appendTo(this),
					
					$("<td/>").appendTo(this),
					$("<td/>").appendTo(this)
					
                },
                "style": "cursor:pointer;",
                "click": function() {
                    // Get into folder and append name to tmp path
                    ssbFileList.expReadDir($(this).attr("data-display-name") + '/', "list");
                }, // ~click
            }).appendTo("#ssbAEDirContentList");

        } // ~for

    }, // ~expRenderDirs()

    /*
        Renders files as list objects
        @param {string} fileArray Array which contains data with files at the given location
        @param {string} [sortBy] Define after which column the files are sorted (Name, Size, Last Modified)
        @param {string} [sortType] Defines after which type the files are sorted (ascending or descending)
     */
    expRenderFiles: function(fileArray, sortBy, sortType) {

        // Sort data array
        fileArray.sort();

        /*
         Iteration for rendering files
         */
        for (xAEfIter = 0; xAEfIter <= ((fileArray.length) - 1); xAEfIter++) {

            // Get element data from array
            // File name
            var expCE_DN_Split = fileArray[xAEfIter][0].split('/');
            var expCE_DisplayName = expCE_DN_Split[(expCE_DN_Split.length) - 1];

            // File size
            var expCE_FileSize = fileArray[xAEfIter][1][0];

            // Make file size easier to read
            // Number(Math.round(1.005+'e2')+'e-2'); // 1.01
            if (expCE_FileSize > 1000000000000) expCE_DisplaySize = Number(Math.round(((((expCE_FileSize / 1000) / 1000) / 1000) / 1000) + 'e1') + 'e-1') + " TB";
            else if (expCE_FileSize > 1000000000) expCE_DisplaySize = Number(Math.round((((expCE_FileSize / 1000) / 1000) / 1000) + 'e1') + 'e-1') + " GB";
            else if (expCE_FileSize > 1000000) expCE_DisplaySize = Number(Math.round(((expCE_FileSize / 1000) / 1000) + 'e1') + 'e-1') + " MB";
            else if (expCE_FileSize > 1000) expCE_DisplaySize = Number(Math.round((expCE_FileSize / 1000) + 'e1') + 'e-1') + " KB";
            else expCE_DisplaySize = expCE_FileSize + " Bytes";

            // Last modified
            var expCE_LastModified = fileArray[xAEfIter][1][1];

            // Open table row tag
            $("<tr/>", {
                "class": "ssbFlDataObject",
                "id": ssbFileList.objectUID,
                "style": "cursor:pointer;",
                "data-type": "file",
                "data-display-name": expCE_DisplayName,
                "data-full-path": fileArray[xAEfIter][0],
                "data-size": fileArray[xAEfIter][1][0],
                "data-last-modified": fileArray[xAEfIter][1][0],
                "html": function() {

                    $("<td/>", {
                        "class": "ssbFlObjIcon",
                        "html": function() {
                            $("<i/>", {
                                "class": "fa fa-file fa-2x",
                                "aria-hidden": "true"
                            }).appendTo(this)
                        }
                    }).appendTo(this),

                    $("<td/>", {
                        "class": "ssbFlObjName",
                        "html": function() {
                            $("<span/>", {
                                "html": expCE_DisplayName
                            }).appendTo(this)
                        }
                    }).appendTo(this),

                    $("<td/>", {
                        "class": "ssbFlObjSize",
                        "html": function() {
                            $("<span/>", {
                                "html": expCE_DisplaySize
                            }).appendTo(this)
                        }
                    }).appendTo(this),

                    $("<td/>", {
                        "class": "ssbFlObjLastModified",
                        "html": function() {
                            $("<span/>", {
                                "html": expCE_LastModified
                            }).appendTo(this)
                        }
                    }).appendTo(this)

                } // ~html

            }).appendTo("#ssbAEDirContentList");

        } // ~for

    }, // ~expRenderFiles()

    /*
        Render the breadcrumb path above the list
        @param {string} expDS Contains the actual path to split into breadcrumbs
     */
    expRenderBCPath: function (expDS) {

        $("#ssbAEDirBCPath").remove();
        var expDS_Split = expDS.split('/');
        var xBCP;

        $("<ol/>", {
            "class": "breadcrumb",
            "id": "ssbAEDirBCPath",
            "html": function() {

                for (xBCP = 0; xBCP <= ((expDS_Split.length) - 2); xBCP++) {

                    if (expDS_Split[xBCP] == "") {

                        $("<li/>", {
                            "style": "cursor:pointer;",
                            "click": function() {
                                ssbFileList.expReadDir('/', "bc")
                            }, // ~click
                            "html": function () {
                                $("<a/>", {
                                    "html": function () {
                                        $("<i/>", {
                                            "class": "fa fa-home"
                                        }).appendTo(this)
                                    } // ~html
                                }).appendTo(this)
                            } // ~html
                        }).appendTo(this);

                    } else {

                        if (xBCP === (expDS_Split.length - 2)) {

                            // Current folder
                            $("<li/>", {
                                "class": "active",
                                "html": expDS_Split[xBCP]
                            }).appendTo(this);

                        } else {

                            // Get pre path
                            var ssbAEBCPrePath = expDS.split(expDS_Split[xBCP]);

                            $("<li/>", {
                                "style": "cursor:pointer;",
                                "data-bc-path": ssbAEBCPrePath[0] + expDS_Split[xBCP],
                                "click": function() {
                                    ssbFileList.expReadDir($(this).attr("data-bc-path") + '/', "bc")
                                },
                                "html": function () {
                                    $("<a/>", {
                                        "html": expDS_Split[xBCP]
                                    }).appendTo(this)
                                } // ~html
                            }).appendTo(this);

                        } // ~else

                    } // ~else

                } // ~for

            } // ~html

        }).appendTo("#ssbAEBCWrapper");


        $("#ssbAEDirBCPath").append("<li><a href=\"#!\" onClick=\"this.expNewElement()\"><i class=\"fa fa-plus\"></i></a></li>");

    }, // ~expRenderBCPath()

	
	
    // Create new element
    expNewElement: function () {

        var expNEContainer = $("#ssbAENewElement");
        expNEContainer.fadeIn();

        // New file
        function expNewFile() {


        } // ~expNewFile()

        // New folder
        function expNewDir() {


        } // ~expNewDir()

    }, // ~expNewElement()
	
	
	
	// Start selective mode
	selectMode: function() {
		
		alert("select mode on");
		
	} // ~selectMode()

} // ~ssbFileList