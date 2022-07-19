
"script":"// JSON Document\n
// LINK NAME CLEANER (auto)\n
// Trigger required: Packagizer Hook\n
// Version 2017.11.14\n
/* *************************************************************************\n
Set the characters that will be removed from both ends of the filename.\n
Be sure to double escape special chars such as \"\\\\s\" instead of \"\\s\".\n
****************************************************************************/\n
\n
var leadAndTrailTrimChars = \"\\\\s-_\\\\s.\";\n
\n
/* *************************************************************************\n
Set the characters that will be replaced with whitespace.\n
Be sure to double escape special chars such as \"\\\\s\" instead of \"\\s\".\n
****************************************************************************/\n
\n
var charToSpace = \"_\";\n\n/* *************************************************************************\n
Set the words or phrases to remove. Words/phrases must be separated with | such as\n
\"word one|word two|word three\"\nBe sure to double escape special chars such as \"\\\\s\" instead of \"\\s\".\n
****************************************************************************/\n
\n
var wordsToRemove = \"www.0xxx|www_0xxx|www|(\\\\s.\\\\s.\\\\s.-)|XVID|DVDRip|dvdrip|xvid|AC3|DVDRiP|WEBRiP|GERMAN|LOVEXXX|HaN|XViD|EAC3D|eac3d|BDRip|NTERNAL|VideoStar|
mihd|0xxx|german|mp4|MP4|XXX|xxx|h264|miHD|H264|h265|H265|WWW|PRD|KTR|filecrypt.cc|Filecrypt.cc|CC|CLIP|CLiP|PL3X|-TRASHBIN|(ws)|(WS)|0XXX|GERMAN|German|2160p|2160P|uhd|
UHD|bluray|BluRay|BLURAY|remux|REMUX|hdr|HDR|hevc|HEVC|webuhd|WEBUHD|webrip|web|WEB|WEBRIP|x265|X265|x264|X264|dl|DL|dts|DTS|dtsd|DTSD|10plus|10Plus|eac3|EAC3|1080p|1080P|
720P|720p|ac3|AC3|dubbed|DUBBED|ac3ld|AC3LD|ld|LD|ENCOUNTERS\";
\n
\n
/***************************************************************************/
\n
\n
if (linkcheckDone) {
\n\n\n    /* =========================== INITIALIZE ============================ */\n
var myPackagizerLink = link;\n    var fileName = myPackagizerLink.getPackageName();\n
\n
var re, ext;\n
\n
// Remove the extension from the end and save it for later.\n    // And make it lower case at the same time.\n    ext = fileName.slice((fileName.lastIndexOf(\".\") - 1 >>> 0) + 2);\n    if (ext !== \"\") {\n        ext = \".\" + ext.toLowerCase();\n    }\n\n    // If extension exists, then we will work with the filename without extension\n    //fileName = fileName.substr(0, (fileName.length - ext.length));\n\n    /* ========================= REGEX PATTERNS ========================== */\n\n    // Remove these words/phrase : wordsToRemove\n    re = new RegExp(\"\\\\b(?:\" + wordsToRemove + \")\\\\b\", \"gi\");\n    fileName = fileName.replace(re, \"\");\n\n\n    // Replace these characters with whitespace : charToSpace\n    re = new RegExp(\"[\" + charToSpace + \"]\", \"gi\");\n    fileName = fileName.replace(re, \" \");\n\n\n    // Delete empty bracket content. \"( )\", \"[ ]\" or \"{ }\" will be removed from filename.    \n    re = new RegExp(\"(\\\\(\\\\s+?\\\\))|(\\\\[\\\\s+?\\\\])|({\\\\s+?})\", \"gi\");\n    fileName = fileName.replace(re, \"\");\n\n\n    /* ====== ALWAYS APPLY NEXT REPLACEMENTS AT THE END OF PROCESS ======= */\n\n    // Replace & with &\n    re = new RegExp(\"&\", \"gi\");\n    fileName = fileName.replace(re, \"&\");\n\n\n    // Remove unwanted characters from both ends of the filename\n    re = new RegExp(\"^[\" + leadAndTrailTrimChars + \"]*(.+?)[\" + leadAndTrailTrimChars + \"]*$\", \"gi\");\n    fileName = fileName.replace(re, \"$1\");\n\n\n    // Replace multiple spaces with only one\n    re = new RegExp(\"\\\\s\\\\s+\", \"gi\");\n    fileName = fileName.replace(re, \"\");\n\n\n    // Removes whitespace from both ends of the filename (just to be sure)\n    fileName = fileName.trim();\n\n\n    /* ====== APPLY NEW FILE NAME ======= */\n    myPackagizerLink.setPackageName(fileName);\n\n}", "eventTriggerSettings":{"isSynchronous":true}, "id":1587990043408},{"eventTrigger":"ON_PACKAGIZER", "enabled":true, "name":"filename", "script":"// JSON Document\n// LINK NAME CLEANER (auto)\n// Trigger required: Packagizer Hook\n// Version 2017.11.14\n/* *************************************************************************\nSet the characters that will be removed from both ends of the filename.\nBe sure to double escape special chars such as \"\\\\s\" instead of \"\\s\".\n****************************************************************************/\n\nvar leadAndTrailTrimChars = \"\\\\s-_\\\\s.\";\n\n/* *************************************************************************\nSet the characters that will be replaced with whitespace.\nBe sure to double escape special chars such as \"\\\\s\" instead of \"\\s\".\n****************************************************************************/\n\nvar charToSpace = \"_\";\n\n/* *************************************************************************\nSet the words or phrases to remove. Words/phrases must be separated with | such as\n\"word one|word two|word three\"\nBe sure to double escape special chars such as \"\\\\s\" instead of \"\\s\".\n****************************************************************************/\nvar wordsToRemove = \"www.0xxx|www_0xxx|www|(\\\\s.\\\\s.\\\\s.-)|XVID|DVDRip|dvdrip|xvid|AC3|DVDRiP|WEBRiP|GERMAN|LOVEXXX|HaN|XViD|EAC3D|eac3d|BDRip|NTERNAL|VideoStar|mihd|0xxx|german|mp4|MP4|XXX|xxx|h264|miHD|H264|h265|H265|WWW|PRD|KTR|filecrypt.cc|Filecrypt.cc|CC|CLIP|CLiP|PL3X|-TRASHBIN|(ws)|(WS)|0XXX|GERMAN|German|2160p|2160P|uhd|UHD|bluray|BluRay|BLURAY|remux|REMUX|hdr|HDR|hevc|HEVC|webuhd|WEBUHD|webrip|web|WEB|WEBRIP|x265|X265|x264|X264|dl|DL|dts|DTS|dtsd|DTSD|10plus|10Plus|eac3|EAC3|1080p|1080P|720P|720p|ac3|AC3|dubbed|DUBBED|ac3ld|AC3LD|ld|LD|ENCOUNTERS\";\n\n\n/***************************************************************************/\n\nif (linkcheckDone) {\n\n\n    /* =========================== INITIALIZE ============================ */\n\n    var fileName = link.getName();\n\n    var re, ext;\n\n    // Remove the extension from the end and save it for later.\n    // And make it lower case at the same time.\n    ext = fileName.slice((fileName.lastIndexOf(\".\") - 1 >>> 0) + 2);\n    if (ext !== \"\") {\n        ext = \".\" + ext.toLowerCase();\n    }\n\n    // If extension exists, then we will work with the filename without extension\n    fileName = fileName.substr(0, (fileName.length - ext.length));\n\n    /* ========================= REGEX PATTERNS ========================== */\n\n    // Remove these words/phrase : wordsToRemove\n    re = new RegExp(\"\\\\b(?:\" + wordsToRemove + \")\\\\b\", \"gi\");\n    fileName = fileName.replace(re, \"\");\n\n\n    // Replace these characters with whitespace : charToSpace\n    re = new RegExp(\"[\" + charToSpace + \"]\", \"gi\");\n    fileName = fileName.replace(re, \" \");\n\n\n    // Delete empty bracket content. \"( )\", \"[ ]\" or \"{ }\" will be removed from filename.    \n    re = new RegExp(\"(\\\\(\\\\s+?\\\\))|(\\\\[\\\\s+?\\\\])|({\\\\s+?})\", \"gi\");\n    fileName = fileName.replace(re, \"\");\n\n\n    /* ====== ALWAYS APPLY NEXT REPLACEMENTS AT THE END OF PROCESS ======= */\n\n    // Replace & with &\n    re = new RegExp(\"&\", \"gi\");\n    fileName = fileName.replace(re, \"&\");\n\n\n    // Remove unwanted characters from both ends of the filename\n    re = new RegExp(\"^[\" + leadAndTrailTrimChars + \"]*(.+?)[\" + leadAndTrailTrimChars + \"]*$\", \"gi\");\n    fileName = fileName.replace(re, \"$1\");\n\n\n    // Replace multiple spaces with only one\n    re = new RegExp(\"\\\\s\\\\s+\", \"gi\");\n    fileName = fileName.replace(re, \"\");\n\n\n    // Removes whitespace from both ends of the filename (just to be sure)\n    fileName = fileName.trim();\n\n\n    /* ====== APPLY NEW FILE NAME ======= */\n    link.setName(fileName + ext);\n\n}", "eventTriggerSettings":{"isSynchronous":true}, "id":1588239029273}]