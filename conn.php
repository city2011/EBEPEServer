<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/12/2
 * Time: 21:40
 */
error_reporting(0);

define('SESSION_DNS', 'mysql:host=localhost;dbname=ebepe;charset=utf8mb4');
define('SESSION_USR', 'root');
define('SESSION_PWD', '8vDesPy4yx1WKxTb');
define('SESSION_MAXLIFETIME', get_cfg_var('session.gc_maxlifetime'));

//创建PDO连接
//持久化连接可以提供更好的效率
function getConnection() {
    try {
        $conn = new PDO(SESSION_DNS, SESSION_USR, SESSION_PWD, array(
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => FALSE
        ));
        return $conn;
    } catch (Exception $ex) {

    }
}