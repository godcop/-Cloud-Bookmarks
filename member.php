<?php

/**
 * @author switch
 * @copyright 2015
 * 用户的主页面，包含该用户所有的当前书签
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    
    //创建变量
    $username = @$_POST['username'];
    $passwd = @$_POST['passwd'];
    
    if($username && $passwd)
    {
        try
        {
            login($username,$passwd);
            //如果该用户在数据库中，则注册会话变量
            $_SESSION['valid_user'] = $username;
        }
        catch(exception $e)
        {
            //登录不成功
            do_html_header('Problem:');
            echo 'You could not be logged in. You must be logged in to view this page.';
            do_html_URL('login.php','Login');
            do_html_footer();
            exit;
        }
    }
    
    do_html_header('Home');
    check_valid_user();
    
    //获取用户的书签
    if($url_array = get_user_urls($_SESSION['valid_user']))
        display_user_urls($url_array);
    //获取用户菜单选项
    display_user_menu();

    do_html_footer();
?>
