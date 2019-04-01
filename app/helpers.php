<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/15
 * Time: 16:16
 */
function trueAjax($msg,$data=[]){
    header('Content-Type:application/json; charset=utf-8');
    $info = [
        'msg' => $msg,
        'data' => $data,
        'flag' => 1
    ];
    exit(json_encode($info));
}
function falseAjax($msg,$data=[]){
    $info = [
        'msg' => $msg,
        'data' => $data,
        'flag' => 0
    ];
    exit(json_encode($info));
}