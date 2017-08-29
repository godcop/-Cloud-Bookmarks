<?php

/**
 * @author switch
 * @copyright 2015
 * 用户修改密码时要填写的表单
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    do_html_header('Change password');
    check_valid_user();
 
    display_password_form();

    display_user_menu(); 
    do_html_footer();
?>