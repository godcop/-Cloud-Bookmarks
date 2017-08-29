<?php

/**
 * @author switch
 * @copyright 2015
 * 连接数据库的函数
 */
    function db_connect()   //连接数据库函数
    {
        $result = new mysqli('localhost', 'bm_user', 'password', 'bookmarks');
        if (!$result) 
        {
            throw new Exception('Could not connect to database server');
        } 
        else 
        {
            return $result;
        }

    }


?>