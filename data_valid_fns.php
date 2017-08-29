<?php

/**
 * @author switch
 * @copyright 2015
 * 确认用户输入数据有效的函数
 */
    function filled_out($form_vars) //检查表单是否填写满
    {
        //当传入参数非数组时可以通过判断或者是强制类型转换来解决
        foreach ((array)$form_vars as $key => $value) 
        {
            if ((!isset($key)) || ($value == '')) 
            {
                return false;
            }
        }
        return true;
    }
    
    function valid_email($address)  //检查邮件地址是否有效
    {
        //正则表达式匹配
        if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/i', $address)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }

    }

?>
