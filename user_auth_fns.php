<?php

/**
 * @author switch
 * @copyright 2015
 * 用户身份验证的函数
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('db_fns.php');
    
    function register($username,$email,$passwd) //注册函数
    {
        $conn = db_connect();   //连接数据库
        
        $result = $conn ->query("select * from user where username='". $username ."'"); //检查该用户名是否注册
        
        if($result ->num_rows > 0)  //已注册，抛出异常
        {
            throw new exception('The username is taken - go back and choose another one.');
        }
        //未注册，则将改用户插入到数据库中
        $result = $conn ->query("insert into user values('". $username ."',sha1('". $passwd ."'),'". $email ."')");
        
        if(!$result)    //无法注册，抛出异常
        {
            throw new exception('Could not register you in database - please try again later.');
        }
        return true;
    }

    function login($username,$passwd)   //登录函数
    {
        $conn = db_connect();   //连接数据库
        
        $result = $conn ->query("select * from user where username='". $username ."' and passwd = sha1('". $passwd ."')");
        
        if(!$result)    //无法登录，抛出异常
            throw new exception('Could not log you in.');
        
        if($result ->num_rows > 0)
            return true;
        else
            throw new exception('Could not log you in.');
    }
    
    function check_valid_user() //检查用户登录是否有效
    {
        if(isset($_SESSION['valid_user']))
            echo "Logged in as ". $_SESSION['valid_user'] .".<br />";
        else
        {
            do_html_heading('Problem:');
            echo 'You are not logged in.<br />';
            do_html_URL('login.php','Login');
            do_html_footer();
            exit;
        }
    }
    
    function change_password($username,$old_password,$new_password) //通过旧密码改密码
    {
        login($username,$old_password);
        $conn = db_connect();
        $result = $conn ->query("update user set passwd = sha1('". $new_password ."') where username ='". $username ."'");
        if(!$result)
            throw new exception('Password could not changed.');
        else
            return true;
    }
    
    function get_random_word($min_length,$max_length)   //从字典里随机获取一个长度在[$min_length,$max_length]的词
    {
        $word = ''; //生成一个随机词
        $dictionary = 'wordlist.txt';
        $fp = @fopen($dictionary,'r');
        if(!$fp)
            return false;
        $size = filesize($dictionary);
        
        $rand_location = rand(0,$size); //找到在字典中一个随机位置
        fseek($fp,$rand_location);
        
        while((strlen($word) < $min_length) || (strlen($word) > $max_length) || (strstr($word,"'")))
        {
            if(feof($fp))
                fseek($fp,0);   //如果到了文件末尾，指向文件头部、
            $word = fgets($fp,80);  //跳过第一个找到的词
            $word = fgets($fp,80);  //第二个
        }
        $word = trim($word);    //去除开头和末尾空格和'\n'
        return $word;   //返回该词
    }
    
    function reset_password($username)  //重置密码
    {
        //获取[6,13]位的随机词，作为新密码
        $new_password = get_random_word(6,13);
        
        if($new_password == false)  //如果获取失败，抛出异常
            throw new exception('Could not generate new password.');
        
        $rand_number = rand(0,999); //获取一个在[0,999]的随机数字
        $new_password .= $rand_number;  //在$new_password后附加$rand_number
        
        $conn = db_connect();   //连接数据库
        $result = $conn ->query("update user set passwd = sha1('". $new_password ."') where username = '". $username ."'");
        
        if(!$result)    //无改变，抛出异常
            throw new exception('Could not change password.');
        else    //重置成功
            return $new_password;
    }
    
    function notify_password($username,$passwd) //通知用户，密码已经更改
    {
        
        $conn = db_connect();   //连接数据库
        $result = $conn ->query("select email from user where username ='". $username ."'");
        
        if(!$result)    //查询不到，抛出异常
            throw new exception('Could not find email address.');
        else if($result ->num_rows == 0)    //用户名不在数据库中
            throw new exception('Could not find email address.');
        else
        {
            $row = $result ->fetch_object();
            //因为没有设置邮件服务器，这里就直接输出密码了
            echo $passwd;
            $email = $row ->email;
            $from = "From: support@phpbookmark \r\n";
            $mesg = "Your PHPBookmark passwrd has been changed to ". $passwd ."\r\n"."Please change it next time you log in.\r\n";
            if(mail($email,'PHPBookmark login information',$mesg,$from))
                return true;
            else
                throw new exception('Could not send email.');
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    

?>