<?php

$wgAutoloadClasses['ShortURLs'] = __DIR__ . "/ShortURLs.php";

$wgAutoloadClasses['ShortURLDupes'] = __DIR__ . "/SpecialShortDuplicates.php";
$wgSpecialPages['ShortUrlDupes'] = "ShortURLDupes";
$wgSpecialPageGroups["ShortURLDupes"] = "wikitranslate";
$wgExtensionMessagesFiles['ShortURLDupes'] = dirname( __FILE__ ) . '/ShortURLs.i18n.php';

$wgAutoloadClasses['ShortURLList'] = __DIR__ . "/SpecialShortList.php";
$wgSpecialPages['ShortUrlList'] = "ShortURLList";
$wgSpecialPageGroups["ShortURLList"] = "wikitranslate";
$wgExtensionMessagesFiles['ShortURLList'] = dirname( __FILE__ ) . '/ShortURLs.i18n.php';
