<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/12/1
 * Time: 23:04
 */
session_start();    //启动Session
$username='nostop';
session_register('username');    //注册一个名为username变量
echo '登记的用户：'.$_SESSION['username'];    //登记的用户：nostop   读取Session变量
$_SESSION['age']=23;    //声明一个名为age的变量，并赋值
echo '年龄：'.$_SESSION['age']; //年龄：23
session_unregister('username'); //注销Session变量
echo $_SESSION['username'];  //空
echo $_SESSION['age'];//23
unset($_SESSION['age']); //注销Session变量
echo '登记的用户：'.$_SESSION['username']; //空
echo '年龄：'.$_SESSION['age']; //空
?>