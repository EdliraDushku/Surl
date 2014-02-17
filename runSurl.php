<?php
include'/var/www/wt/user/config.php';
//global $wgSurlDb, $wgSurl;
shell_exec('php dumpShortURLs.php | xargs -i{} echo "REPLACE INTO yourls_url (keyword,url, ip, clicks) VALUES ({}, \'0.0.0.0\', 0);" | mysql -u '.YOURLS_DB_USER.' -p'.YOURLS_DB_PASS.' '.YOURLS_DB_NAME);

?>
