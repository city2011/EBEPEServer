<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/12/6
 * Time: 16:13
 */
require 'connect.php';
require 'response_form.php';
$response = new Response();
startSession();
$conn = getConnection();
$sessionId = session_id();

if(!$_POST['esradio1'] || !$_POST['esradio2'] || !$_POST['adradio1']
    || !$_POST['adradio2']|| !$_POST['adname']|| !$_POST['age']
    || !$_POST['gender']|| !$_POST['readtime']|| !$_POST['type']){
    $response->rcode=5;
    $response->rcontent='missing parameter';
    sessionMysqlClose();
    die(json_encode($response));
}

function inject_check($Sql_Str,$con,$response) {
    $check=preg_match('/select|insert|update|delete|\'|\\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i',$Sql_Str);
    if ($check) {
        $response->rcode=11;
        $response->rcontent='illegal character';
        sessionMysqlClose();
        die(json_encode($response));
    }else{
        return $Sql_Str;
    }}

$adname = inject_check($_POST['adname'],$conn,$response);

if(!$conn)
{
    sessionMysqlClose();
    $response->rcode = 2;
    $response->rcontent = "数据库错误！";
}

$result = sessionMysqlWrite($sessionId,$adname);
if($result == 0)
{
    $response->rcode=0;
    $response->rcontent='success';
    sessionMysqlClose();
    die(json_encode($response));
}else
{
    $response->rcode=7;
    $response->rcontent='插入错误';
    sessionMysqlClose();
    die(json_encode($response));
}




?>
