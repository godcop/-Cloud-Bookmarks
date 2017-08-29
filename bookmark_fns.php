<?php

/**
 * @author switch
 * @copyright 2015
 * 应用程序的包含文件集合
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('data_valid_fns.php'); //确认用户输入数据有效的函数
    require_once('db_fns.php'); // 连接数据库的函数
    require_once('user_auth_fns.php');  //用户身份验证的函数
    require_once('output_fns.php'); //以HTML形式格式化输出的函数
    require_once('url_fns.php');    //增加和删除书签的函数
?>
