<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/12/6
 * Time: 16:13
 */
require 'connect.php';
require 'response_form.php';
require  'Info.php';
$response = new Response();
startSession();

if(!$_POST['esradio1'] || !$_POST['esradio2'] || !$_POST['adradio1']
    || !$_POST['adradio2']|| !$_POST['adname']|| !$_POST['age']
    || !$_POST['gender']|| !$_POST['readtime']|| !$_POST['type'])
{
    $response->rcode=5;
    $response->rcontent='missing parameter';
    die(json_encode($response));
}

function inject_check($Sql_Str,$response) {
    $check=preg_match('/select|insert|update|delete|\'|\\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i',$Sql_Str);
    if ($check) {
        $response->rcode=11;
        $response->rcontent='illegal character';
        die(json_encode($response));
    }else{
        return $Sql_Str;
    }}


$esradio1 = $_POST['esradio1'];
$esradio2 = $_POST['esradio2'];
$adradio1 = $_POST['adradio1'];
$adradio2 = $_POST['adradio2'];
$adname = inject_check($_POST['adname'],$response);
$age = inject_check($_POST['age'],$response);
$gender = inject_check($_POST['gender'],$response);
$readtime = $_POST['readtime'];
$type = $_POST['type'];

$information = new Info($esradio1,$esradio2,$adradio1,$adradio2,$adname,$age,$gender,$readtime,$type);
//$result = sessionMysqlWrite($sessionId,$adname);
//if(!$result)
//{
//    $response->rcode=1;
//    $response->rcontent='wrong';
//    sessionMysqlClose();
//    die(json_encode($response));
//}

$_SESSION['info'] =$information;

//if($result)
//
    $response->rcode= 0;
    $response->rcontent = $information;
    die(json_encode($response));
//}else
//{
//    $response->rcode=7;
//    $response->rcontent='插入错误';
//    sessionMysqlClose();
//    die(json_encode($response));
//}
?>
