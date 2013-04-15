<?php
$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( Reg::get('usr')->email ) ) ) . "?d=identicon&s=100";
$avatar_url = $grav_url;
Reg::get("smarty")->assign("avatar_url", $avatar_url);


