<?php
Reg::get('packageMgr')->usePlugin("Users", "UserValidation");

Reg::get('formKey')->validate((isset($_POST['key']) ? $_POST['key'] : null));

$data = $_POST['p'];

$name 			= (isset($data['fullname'])) ? $data['fullname'] : '';
$birthdate		= (isset($data['birthdate'])) ? $data['birthdate'] : null;
$sex 			= (isset($data['gender'])) ? $data['gender'] : 0;
$emailAlertBoy	= (isset($data['register_male'])) ? '1' : '0';
$emailAlertGirl = (isset($data['register_female'])) ? '1' : '0';

if(!empty($birthdate)){
    Reg::get('userValidation')->checkBirthDate($birthdate);
    Reg::get('usr')->props->birthdate = date(DEFAULT_DATE_FORMAT,  strtotime($birthdate));
}


if(Reg::get('userValidation')->hasError()){
    foreach(Reg::get('userValidation')->getErrors() as $err){
        Reg::get('error')->add($err);
    }
    $_SESSION["editAccountPostData"] = $data;

    redirect(Reg::get('rewriteURL')->glink('profile'));
}
else{
    Reg::get('usr')->props->sex = $sex;
    Reg::get('usr')->props->name = htmlspecialchars($name);
    Reg::get('usr')->props->facebook = htmlspecialchars($data['facebook']);
    Reg::get('usr')->props->twitter = htmlspecialchars($data['twitter']);
    Reg::get('usr')->props->skype = htmlspecialchars($data['skype']);
    Reg::get('usr')->props->emailAlertBoy = $emailAlertBoy;
    Reg::get('usr')->props->emailAlertGirl = $emailAlertGirl;

    Reg::get('userMgr')->updateUser(Reg::get('usr'));
    if(isset($_SESSION['editAccountPostData']))   unset($_SESSION['editAccountPostData']);

    Reg::get('info')->add(SUCCESS_PROFILE_UPDATE);
    redirect(SITE_PATH . 'profile');
}
