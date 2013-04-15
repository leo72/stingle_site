<?php
// Do not show the page when user is
// already logged in
if(isAuthorized()){
    redirect(Reg::get('rewriteURL')->glink('profile'));
}
Reg::get('smarty')->addJs('jqueryPlugins/jquery.validate.min.js');
Reg::get('smarty')->addJsSmart('registration.js');
Reg::get('smarty')->assign('recaptcha', Reg::get('recaptcha'));
