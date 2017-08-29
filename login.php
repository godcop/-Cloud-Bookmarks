<?php

/**
 * @author switch
 * @copyright 2015
 * 包含系统登录表单的页面
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');   //应用程序的包含文件集合
    
    do_html_header(''); //HTML标题
    
    display_site_info();//HTML站点信息
    display_login_form();//HTML登录信息
    
    do_html_footer();   //HTML页脚
?>
