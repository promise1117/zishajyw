<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function returnResponse($code,$msg = '',$data=array()){
    $retData = array(
        'code' => $code,
        'message' => $msg,
        'data' => $data?$data:'',
    );
    #错误时不显示data
    if($code != 200){
        unset($retData['data']);
    }
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($retData));
}