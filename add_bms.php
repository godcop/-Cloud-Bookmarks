<?php

/**
 * @author switch
 * @copyright 2015
 * 添加书签的表单
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    
    //创建变量
    $new_url = $_POST['new_url'];
    
    do_html_header('Adding bookmarks');
    
    try
    {
        check_valid_user(); //检查用户有效性
        if(!filled_out($new_url))   //检查表单是否填写
            throw new exception('Form not completely filled out.');
        if(strstr($new_url,'http://') === false)
            $new_url = 'http://'. $new_url;
        if(!(@fopen($new_url,'r'))) //可以调用fopen()函数打开URL，如果能打开这个文件，则假定URL是有效的
            throw new exception('Not a valid URL.');
        add_bm($new_url);   //将URL添加到数据库中
        echo 'Bookmark added.';
        if($url_array = get_user_urls($_SESSION['valid_user']))
            display_user_urls($url_array);
    }
    catch(exception $e)
    {
        echo $e ->getMessage();
    }
    display_user_menu();
    do_html_footer();
?>