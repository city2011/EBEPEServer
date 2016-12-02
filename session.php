<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/11/30
 * Time: 23:11
 */
$savePath = "./session_save_dir/";
$lifeTime = 15 * 60;
session_save_path($savePath);
session_set_cookie_params($lifeTime);
session_start();
$name = "这是一个Session的例子";
//Session_Register("Name");

if (isset($_SESSION['Name']))
{
    echo "has logined before";
    $sessionName = session_name('Name');
    $sessionID = $_GET[$sessionName];
    echo $sessionID;
    session_id($sessionID);
}
else {
    echo "first time login";
    $_SESSION['Name'] = $name;
}

?>