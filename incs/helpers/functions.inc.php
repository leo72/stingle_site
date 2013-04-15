<?php
/**
 * Do post creation actions,
 *
 * @param User $user
 * @param bool $redirectTo
 * @param bool $withOutput
 */
function userCreationActions(User $user, $redirectTo = SITE_PATH, $withOutput = true, $withRedirect = true){

    if($withOutput){
        Reg::get('info')->add(REGISTER_SUCCESS);
    }

    doLoginDirect($user);

    if($withRedirect){
        redirect($redirectTo);
    }
}

/**
 * Log in user directly by object
 * @param User $user
 * @param array $additionalCredentials
 * @param bool $remember
 */
function doLoginDirect(User $user, $additionalCredentials = array(), $remember = false){
    try{
        $usr = Reg::get('userAuth')->doLogin($user->id, $additionalCredentials, $remember);
        Reg::register("usr", $usr, true);
    }
    catch(UserAuthFailedException $e){
        Reg::get('error')->add(INC_LOGIN_PASS);
        redirect(SITE_PATH);
    }
}

function is_logined(){
    if(!isAuthorized()){
        if(empty($_GET["ajax"])){
            $_SESSION['redirect_after_login']=$_SERVER["REQUEST_URI"];
            Reg::get('error')->add(ERR_YOU_HAVE_TO_LOGIN);
        }
        redirect(SITE_PATH);
    }
    return true;
}


function postLoginOperations(){

    if(isAuthorized()){
        // Check user's preffered host. If user login from another host, set it as preffered
        if(Reg::get('usr')->props->hostId != Reg::get('host')->id){
            Reg::get('usr')->props->hostId = Reg::get('host')->id;
        }

        // Check user's preffered language. If user login using another language, set it as preffered
        if(Reg::get('usr')->props->langId != Reg::get('language')->id){
            Reg::get('usr')->props->langId = Reg::get('language')->id;
        }

        // Update user's last IP
        if(Reg::get('usr')->lastLoginIP != $_SERVER['REMOTE_ADDR']){
            Reg::get('usr')->lastLoginIP = $_SERVER['REMOTE_ADDR'];
        }

        Reg::get('userMgr')->updateUser(Reg::get('usr'));
    }

    if(isset($_SESSION['redirect_after_login']) and !empty($_SESSION['redirect_after_login'])){
        $redirectUrl = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        redirect($redirectUrl);
    }
    else{
        redirect(SITE_PATH);
    }
}

/**
 * Delete entries from memcache for given classes
 *
 * @param array|string $keys
 * @return integer
 */
function deleteMemcacheKeys($classes, $customGlobalPrefix = null){
    if(!ConfigManager::getConfig("Db", "Memcache")->AuxConfig->enabled){
        return 0;
    }

    if(!is_array($classes)){
        $classes = array($classes);
    }

    if($customGlobalPrefix !== null){
        $globalPrefix = $customGlobalPrefix;
    }
    else{
        $globalPrefix = ConfigManager::getConfig("Db", "Memcache")->AuxConfig->keyPrefix;
    }

    $memcacheConfig = ConfigManager::getConfig('Db','Memcache')->AuxConfig;
    $memcached = new MemcacheWrapper($memcacheConfig->host, $memcacheConfig->port);

    $list = $memcached->getKeysList();

    $count = 0;
    foreach ($list as $key){
        $array = explode(":", $key);
        if(count($array) == 3){
            if($array[0] == $globalPrefix and in_array($array[1], $classes)){
                if($memcached->delete($key)){
                    $count++;
                }
            }
        }
    }

    return $count;
}