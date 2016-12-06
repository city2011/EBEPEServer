<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/12/6
 * Time: 11:28
 *
 * 连接数据库所需的DNS、用户名、密码等，一般情况不会在代码中进行更改，
 * 所以使用常量的形式，可以避免在函数中引用而需要global。
 */
define('SESSION_DNS', 'mysql:host=localhost/ebepe;dbname=ebepe;charset=utf8mb4');
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

//自定义的session的open函数
function sessionMysqlOpen($savePath, $sessionName) {
    return TRUE;
}

//自定义的session的close函数
function sessionMysqlClose() {
    return TRUE;
}
/*
 * 由于一般不会把用户提交的数据直接保存到session，所以普通情况不存在注入问题。
 * 且处理session数据的SQL语句也不会多次使用。因此预处理功能的效益无法体现。
 * 所以，实际工程中可以不必教条的使用预处理功能。
 */
/*
 * sessionMysqlRead()函数中，首先通过SELECT count(*)来判断sessionID是否存在。
 * 由于MySQL数据库提供SELECT对PDOStatement::rowCount()的支持，
 * 因此，实际的工程中可以直接使用rowCount()进行判断。
 */
//自定义的session的read函数
//SQL语句中增加了“expire > time()”判断，用以避免读取过期的session。
function sessionMysqlRead($sessionId) {
    try {
        $dbh = getConnection();
        $time = time();

        $sql = 'SELECT count(*) AS `count` FROM session '
            . 'WHERE skey = ? and expire > ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId, $time));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data['count'] = 0) {
            return '';
        }

        $sql = 'SELECT `data` FROM `session` '
            . 'WHERE `skey` = ? and `expire` > ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId, $time));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['data'];
    } catch (Exception $e) {
        return '';
    }
}

//自定义的session的write函数
//expire字段存储的数据为当前时间+session生命期，当这个值小于time()时表明session失效。
function sessionMysqlWrite($sessionId, $data) {
    try {
        $dbh = getConnection();
        $expire = time() + SESSION_MAXLIFETIME;

        $sql = 'INSERT INTO `session` (`skey`, `data`, `expire`) '
            . 'values (?, ?, ?) '
            . 'ON DUPLICATE KEY UPDATE data = ?, expire = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId, $data, $expire, $data, $expire));
        return 0;
    } catch (Exception $e) {
        return 1;
        echo $e->getMessage();
    }
}

//自定义的session的destroy函数
function sessionMysqlDestroy($sessionId) {
    try {
        $dbh = getConnection();

        $sql = 'DELETE FROM `session` where skey = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId));
        return TRUE;
    } catch (Exception $e) {
        return FALSE;
    }
}

//自定义的session的gc函数
function sessionMysqlGc($lifetime) {
    try {
        $dbh = getConnection();

        $sql = 'DELETE FROM `session` WHERE expire < ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(time()));
        $dbh = NULL;
        return TRUE;
    } catch (Exception $e) {
        return FALSE;
    }
}

//自定义的session的session id设置函数
/*
 * 由于在session_start()之前，SID和session_id()均无效，
 * 故使用$_GET[session_name()]和$_COOKIE[session_name()]进行检测。
 * 如果此两者均为空，则表明session尚未建立，需要为新session设置session id。
 * 通过MySQL数据库获取uuid作为session id可以更好的避免session id碰撞。
 */
function sessionMysqlId() {
    if (filter_input(INPUT_GET, session_name()) == '' and
        filter_input(INPUT_COOKIE, session_name()) == '') {
        try {
            $dbh = getConnection();
            $stmt = $dbh->query('SELECT uuid() AS uuid');
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = str_replace('-', '', $data['uuid']);
            session_id($data);
            return TRUE;
        } catch (Exception $ex) {
            return FALSE;
        }

    }
}

//session启动函数，包括了session_start()及其之前的所有步骤。
function startSession() {
    session_set_save_handler(
        'sessionMysqlOpen',
        'sessionMysqlClose',
        'sessionMysqlRead',
        'sessionMysqlWrite',
        'sessionMysqlDestroy',
        'sessionMysqlGc');
    register_shutdown_function('session_write_close');
    sessionMysqlId();
    session_start();
}

?>