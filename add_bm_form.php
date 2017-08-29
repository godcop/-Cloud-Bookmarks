<?php

/**
 * @author switch
 * @copyright 2015
 * 添加书签的表单
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();

    do_html_header('Add Bookmarks');

    check_valid_user();
    display_add_bm_form();

    display_user_menu();
    do_html_footer();
?>
