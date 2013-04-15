<?php
/**
 * Date: 3/9/13
 */

Reg::get('packageMgr')->usePlugin("Users", "UserValidation");

$data = $_POST['r'];

$data['username'] = trim($data['username']);

$licence 		= (isset($data['terms'])) ? $data['terms'] : null;
$sex 			= (isset($data['gender'])) ? $data['gender'] : 0;
$email			= (isset($data['email'])) ? $data['email'] : null;
$password		= (isset($data['password'])) ? $data['password'] : null;
$password2		= (isset($data['rpassword'])) ? $data['rpassword'] : null;

Reg::get('userValidation')->checkLicence($licence);
Reg::get('userValidation')->checkSex($sex);
Reg::get('userValidation')->checkPasswords($password, $password2);



if(Reg::get('userValidation')->checkUsername($data['username'])){
    Reg::get('userValidation')->checkUserExists($data['username']);
}


if(Reg::get('userValidation')->checkEmail($email)){
    Reg::get('userValidation')->checkEmailExist($email);
}


//////////////////////////////////////////////// captcha ///////////////

$resp = Reg::get('recaptcha')->checkAnswer($_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

if (!$resp->is_valid){
    Reg::get('error')->add("Incorrect words from captcha.");
}


if(Reg::get('userValidation')->hasError() or  !Reg::get('error')->isEmptyQueue()){
    foreach(Reg::get('userValidation')->getErrors() as $err){
        Reg::get('error')->add($err);
    }
}
else{
    $usr = new User();
    $props = new UserProperties();
    $usr->props = $props;

    $usr->login 		= $data['username'];
    $usr->password 		= $password;
    $usr->email 		= $email;
    $props->sex 		= $sex;

    $props->langId 		= Reg::get('language')->id;
    $props->hostId 		= Reg::get('host')->id;

    $userId = Reg::get('userMgr')->createUser($usr);
    try{
        $usr = Reg::get('userMgr')->getUserById($userId);
        Reg::get('userGroupsMgr')->addUserToGroup($usr, Reg::get('userGroupsMgr')->getGroupByName(UserGroupsManager::GROUP_USERS));

        //TODO:: Reg::get('mail')->activation($usr);
        if(isset($_SESSION['registrationData']))   unset($_SESSION['registrationData']);
        userCreationActions($usr, SITE_PATH . "profile/tag:successReg");
    }
    catch (UserNotFoundException $e){
        Reg::get('error')->add(ERR_USER_DOES_NOT_EXIST);
    }
}
unset($data['password']);
unset($data['rpassword']);
$_SESSION["registrationData"] = $data;

redirect(Reg::get('rewriteURL')->glink('auth/registration'));
