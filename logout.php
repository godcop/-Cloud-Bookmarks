<?php

/**
 * @author switch
 * @copyright 2015
 * 将用户注销的脚本
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    $old_user = $_SESSION['valid_user'];
    
    //注销会话变量
    unset($_SESSION['valid_user']);
    $result_dest = session_destroy();
    
    do_html_header('Logging Out');
    
    if(!empty($old_user))
    {
        if($result_dest)    //登出成功
        {
            echo 'Logged out.<br />';
            do_html_URL('login.php','Login');
        }
        else    //不成功
        {
            echo 'Could not log you out.<br />';
        }
    }
    else
    {
        echo 'You were not logged in, and so have not been logged ot.<br />';
        do_html_URL('login.php','Login');
    }
    do_html_footer();
?>
