<?php
/* Validate form*/
Reg::get('formKey')->validate((isset($_POST['key']) ? $_POST['key'] : null));
if(empty($_POST['lemail']) OR empty($_POST['lpassword'])){
    Reg::get('error')->add(INC_LOGIN_PASS . " (Empty)");
    redirect(Reg::get('rewriteURL')->glink('auth'));
}
/*Do login*/
try{
    $filter = new UsersFilter();
    $filter->setEmail($_POST['lemail']);
    $tmpUser = Reg::get('userMgr')->getUser($filter);

    $usr = Reg::get('userAuth')->checkCredentials($tmpUser->login, $_POST['lpassword'], array(), (!empty($_POST['remember']) ? true : false));
    Reg::register("usr", $usr, true);
}
catch (Exception $e){
    if ($e instanceof UserNotFoundException OR $e instanceof RequestLimiterTooManyAuthTriesException OR $e instanceof UserAuthFailedException) {
        Reg::get('error')->add(INC_LOGIN_PASS);
        if(isInDevelopmentMode()){
            Reg::get('error')->add($e->getMessage());
        }
        Reg::get('uo')->redirect(Reg::get('rewriteURL')->glink('auth'));
    }
    else{
      throw($e);
    }
}
if(Reg::get('error')->isEmptyQueue()){
        postLoginOperations();
}

