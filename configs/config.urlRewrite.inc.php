<?php
/**
 * Handler script for whole site
 * @var string
 */
$CONFIG['RewriteURL']['RewriteURL']['AuxConfig']['handler_script'] = "index.php";
/**
 * mod_rewrite configurations
 * ON/OFF
 */
$CONFIG['RewriteURL']['RewriteURL']['AuxConfig']['enable_url_rewrite'] = "ON";

/**
 * Style of links used in templates. 
 * "nice" or "default".
 */
$CONFIG['RewriteURL']['RewriteURL']['AuxConfig']['source_link_style'] = 'nice';

/**
 * Style of links to be outputed. "nice" or "default".
 * If use nice ENABLE_URL_REWRITE is ON.
 */
$CONFIG['RewriteURL']['RewriteURL']['AuxConfig']['output_link_style'] = 'nice';
//********************************//

/**
 * Rewrite search queries in readable view
 * This constant used in search/result.php
 * ON/OFF
 */
$CONFIG['RewriteURL']['RewriteURL']['AuxConfig']['rewrite_search_url'] = "ON";

/**
 * Set the name of the project folder www.mysite.com/[SITE_PATH]
 * This constant particularly used by RewriteUrl class.
 * NOTE: Change "RewriteBase" in .httaccess to [SITE_PATH]
 */
$CONFIG['RewriteURL']['RewriteURL']['AuxConfig']['site_path'] = "/";
