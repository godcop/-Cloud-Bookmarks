<?php

/**
 * @author switch
 * @copyright 2015
 * 用户忘记密码后需要填写的表单
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    do_html_header('Reset password');
 
    display_forgot_form();

    do_html_footer();



?>
