<?php

/**
 * @author switch
 * @copyright 2015
 * 处理新注册信息的脚本
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('bookmark_fns.php');
    
    //创建变量
    $email = $_POST['email'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $passwd2 = $_POST['passwd2'];

    //开启会话
    session_start();
    
    try
    {
        //检查表单是否填写满
        if(!filled_out($_POST))
        {
            throw new exception('You have not filled the form out correctly - please go back and try again.');
        }
        
        //检查邮件地址是否有效
        if(!valid_email($email))
        {
            throw new exception('That is not a vald email address. Please go back try again.');
        }
        
        //检查两次输入密码是否相同
        if($passwd != $passwd2)
        {
            throw new exception('The passwords you entered do not match - please go back try again.');
        }
        
        //检查密码长度是否合格
        if((strlen($passwd) < 6) || (strlen($passwd) > 16))
        {
            throw new exception('Your password must be between 6 and 16 characters Please go back and try again.');
        }
        
        //尝试注册
        register($username,$email,$passwd);
        
        //注册会话变量
        $_SESSION['valid_user'] = $username;
        
        //提供成员页面链接
        do_html_header('Registration successful');  //HTML标题
        echo 'Your registration was successful.Go to the members page to start setting up your bookmarks!'; //输出URL
        do_html_URL('member.php','Go to members page'); //HTML页脚
        do_html_footer();   //HTML页脚
    }
    catch(exception $e)
    {
        do_html_header('Problem:');
        echo $e->getMessage();
        do_html_footer();
        exit;
    }
?>
