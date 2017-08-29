<?php

/**
 * @author switch
 * @copyright 2015
 * 从用户的书签列表中删除选定书签的脚本呢
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    session_start();
    
    //创建变量
    $del_me = @$_POST['del_me'];
    $valid_user = $_SESSION['valid_user'];
    
    do_html_header('Deleting bookmarks');
    check_valid_user();
    
    if(!filled_out($del_me))    //
    {
        echo '<p>You have not chosen any bookmarks to delete.<br />Please try again.</p>';
        display_user_menu();
        do_html_footer();
        exit;
    }
    else
    {
        if(count($del_me) > 0)
        {
            foreach($del_me as $url)
            {
                if(delete_bm($valid_user,$url))
                {
                    echo 'Deleted '. htmlspecialchars($url) .'.<br />';
                }
                else
                {
                    echo 'Could not delete '. htmlspecialchars($url) .'.<br />';
                }
            }
        }
        else
        {
            echo 'No bookmarks selected for deletion';
        }
    }
    if($url_array = get_user_urls($valid_user))
    {
        display_user_urls($url_array);
    }
    display_user_menu();
    do_html_footer();
?>
