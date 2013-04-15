<?php
// Do not show the page when user is
// already logged in
if(isAuthorized()){
    redirect(Reg::get('rewriteURL')->glink('profile'));
}