<?php

/**
 * @author switch
 * @copyright 2015
 * 重新设置遗忘密码的脚本
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    do_html_header("Resetting password");
    
    //创建变量
    $username = $_POST['username'];
    
    try
    {
        $passwd = reset_password($username);
        notify_password($username,$passwd);
        echo 'Your new password has been emailed to you.<br />';
    }
    catch(exception $e)
    {
        echo 'Your password could not be reset - please try again later.';
    }
    do_html_URL('login.php','Login');
    do_html_footer();
?>
