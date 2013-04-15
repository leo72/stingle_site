<?php
Reg::get('formKey')->validate((isset($_POST['key']) ? $_POST['key'] : null));
if(empty($_POST['passEmail'])){
    Reg::get('error')->add(ENTER_EMAIL );
    redirect(Reg::get('rewriteURL')->glink('auth/fpass'));
}
else{
    //TODO::Send new password to email
}