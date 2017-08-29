<?php

/**
 * @author switch
 * @copyright 2015
 * 修改数据库中用户密码的表单
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    do_html_header('Changing password');
    
    //创建变量
    $old_passwd = $_POST['old_passwd'];
    $new_passwd = $_POST['new_passwd'];
    $new_passwd2 = $_POST['new_passwd2'];
    
    try
    {
        check_valid_user();
        if(!filled_out($_POST))
            throw new exception('You have not filled out the form completely.Please try again.');
        
        if($new_passwd != $new_passwd2)
            throw new exception('Passwords entered were not the same. Not changed.');
            
        if((strlen($new_passwd) > 16) || (strlen($new_passwd) < 6))
        {
            throw new exception('New password must be between 6 and 16 characters. Try again.');
        }
        
        //尝试修改
        change_password($_SESSION['valid_user'],$old_passwd,$new_passwd);
        echo 'Password changed.';
    }
    catch(exception $e)
    {
        echo $e ->getMessage();
    }
    display_user_menu();
    do_html_footer();
?>
