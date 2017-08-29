<?php

/**
 * @author switch
 * @copyright 2015
 * 系统中用户注册表单
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    do_html_header('User Registration');    //HTML标题
    
    display_registeration_form();   //输出注册表单
    
    do_html_footer();   //HTML页脚
?>
