<?php

/**
 * @author switch
 * @copyright 2015
 * 基于用户以前的操作，推荐用户可能感兴趣的书签
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    do_html_header('Recommending URLs');
    try
    {
        check_valid_user();
        $urls = recommend_urls($_SESSION['valid_user']);
        display_recommended_urls($urls);
    }
    catch(exception $e)
    {
        echo $e ->getMessage();
    }
    display_user_menu();
    do_html_footer();
?>