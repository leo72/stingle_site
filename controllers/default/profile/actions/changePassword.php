<?php
Reg::get('packageMgr')->usePlugin("Users", "UserValidation");

$password		= (isset($_POST['password'])) ? $_POST['password'] : null;
$password2		= (isset($_POST['password2'])) ? $_POST['password2'] : null;

Reg::get('userValidation')->checkPasswords($password, $password2);

if(Reg::get('userValidation')->hasError() or  !Reg::get('error')->isEmptyQueue()){
    foreach(Reg::get('userValidation')->getErrors() as $err){
        Reg::get('error')->add($err);
    }
}
else{
    if(!Reg::get('userMgr')->setUserPassword(Reg::get('usr'), $_POST['password'])){
        Reg::get('error')->add("Can't set password.");
    }
    else{
        $config = ConfigManager::getConfig("Users","Users")->AuxConfig;
        try{
            $usr = Reg::get('userAuth')->checkCredentials(Reg::get('usr')->login, $_POST['password'], null, (!empty($_COOKIE[$config->loginCookieName]) ? true : false));
            Reg::register("usr", $usr, true);
        }
        catch(Exception $e){
            redirect(Reg::get('rewriteURL')->glink('auth'));
        }
        Reg::get('info')->add("Password is successfully changed.");
    }

}
redirect(Reg::get('rewriteURL')->glink('profile'));