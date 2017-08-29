<?php

/**
 * @author switch
 * @copyright 2015
 * 增加和删除书签的函数
 */
    //require_once语句和require语句完全相同,唯一区别是PHP会检查该文件是否已经被包含过,如果是则不会再次包含。
    require_once('db_fns.php');
    
    function get_user_urls($username)   //提取用户所有的URL
    {
        $conn = db_connect();
        $result = $conn ->query("select bm_URL from bookmark where username ='". $username ."'");
        if(!$result)
            return false;
        //创建URLs数组
        $url_array = array();
        for($count = 1; $row = $result ->fetch_row(); ++$count)
            $url_array[$count] = $row[0];
        return $url_array;
    }

    function add_bm($new_url)   //添加新的书签到数据库
    {
        echo "Attempting to add ". htmlspecialchars($new_url) ."<br />";
        $valid_user = $_SESSION['valid_user'];
        
        $conn = db_connect();   //连接数据库
        
        $result = $conn ->query("select * from bookmark where username ='$valid_user' and bm_URL ='". $new_url ."'");
        if($result && ($result ->num_rows > 0))
            throw new exception('Bookmark already exists.');
        
        //添加书签
        if(!$conn ->query("insert into bookmark values('". $valid_user ."','". $new_url ."')"))
            throw new exception('Bookmark could not be inserted.');
        return true;
    } 
    
    function delete_bm($user,$url)   //删除书签
    {
        $conn = db_connect();   //连接数据库
        
        //删除书签
        if(!$conn ->query("delete from bookmark where username = '". $user ."' and bm_URL = '". $url ."'"))
            throw new exception('Bookmark could not be deleted.');
        return true;
    }
    
    function recommend_urls($valid_user, $popularity = 1) //推荐书签
    {
        $conn = db_connect();   //连接数据库
        
        //找其他用户中与你有相同书签的人之后，搜索他的其他书签
        //如果那个书签被两个用户以上拥有
        //那么就将这个书签推荐给你
        
        $query = "select bm_URL from bookmark 
                where username in (select distinct(b2.username) 
                from bookmark b1,bookmark b2 
                where b1.username ='". $valid_user ."' 
                and b1.username != b2.username 
                and b1.bm_URL = b2.bm_URL) 
                and bm_URL not in 
                (select bm_URL from bookmark 
                where username ='". $valid_user ."') 
                group by bm_URL having count(bm_URL) >". $popularity;
        if(!($result = $conn ->query($query)))
            throw new exception('Could not find any bookmarks to recommend.');
        
        if($result ->num_rows == 0)
            throw new exception('Could not find any bookmarks to recommend.');
        
        $urls = array();
        
        for($count = 0; $row = $result->fetch_object(); $count++)
            $urls[$count] = $row ->bm_URL;
        return $urls;
    }
?>
