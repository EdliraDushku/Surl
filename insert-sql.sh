#!/bin/sh

php /var/www/wikitranslate/w/extensions/WikiTranslate/dumpShortURLs.php | xargs -i{} echo "REPLACE INTO yourls_url (keyword,url, ip, clicks) VALUES ({}, '0.0.0.0', 0);" | mysql -u root -proot wikitra2_url
