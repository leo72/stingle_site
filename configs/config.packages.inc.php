<?php
///////////  Which packages to load on the site  ///////////

$CONFIG['Packages'][] = array("Output", "ExtendedSmarty");
$CONFIG['Packages'][] = array("Host", "HostControllerTemplate");
$CONFIG['Packages'][] = array("SiteNavigation");
$CONFIG['Packages'][] = array("Db", "Memcache;QueryBuilder");
$CONFIG['Packages'][] = array("Security","Security;FormKey;IpFilter;OneTimeCodes");
$CONFIG['Packages'][] = array("Comet", "Comet;CometAbort;CometEvents");
$CONFIG['Packages'][] = array("RewriteURL", "RewriteCustomAliasURL");
$CONFIG['Packages'][] = array("Pager", "MysqlPager");
$CONFIG['Packages'][] = array("Info");
$CONFIG['Packages'][] = array("GeoIP");
$CONFIG['Packages'][] = array("Language","HostLanguage");
$CONFIG['Packages'][] = array("Config", "ConfigDB");
$CONFIG['Packages'][] = array("PageInfo");
$CONFIG['Packages'][] = array("JSON");
$CONFIG['Packages'][] = array("Captcha", "Recaptcha");
$CONFIG['Packages'][] = array("Users");
