<?php
/* 
 * 本软件为免费、开源软件。
 * 本软件的版权(包括源码及二进制发布版本)归一切公众所有。
 * 您可以自由使用、传播本软件。
 * 您也可以以任何形式、任何目的使用本软件(包括源码及二进制发布版本)，而不受任何版权限制。
 * =====================
 * 作者: 孙明保
 * 邮箱: sunmingbao@126.com
 */


    $login_url="Location:/cgi-bin/login_ui.php";

    function login_restrict()
    {
        global $login_url;
        session_start();
        if(!isset($_SESSION['user_name']) || $_SESSION['user_name']=='') 
        {
            header($login_url);
            exit(0);
        }
    }

    function user_restrict($user_type)
    {
        global $login_url;
        session_start();
        if(!isset($_SESSION['user_name']) || $_SESSION['user_type']!=$user_type) 
        {
            header($login_url);
            exit(0);
        }
    }

    function user_name_restrict($user_name)
    {
        global $login_url;
        session_start();
        if(!isset($_SESSION['user_name']) || $_SESSION['user_name']!=$user_name) 
        {
            header($login_url);
            exit(0);
        }
    }

    function user_has_login()
    {
        session_start();
        if(!isset($_SESSION['user_name']) || $_SESSION['user_name']=='') 
        {
            return false;
        }

        return true;
    }

    function user_time($time_value)
    {
        session_start();
        date_default_timezone_set($_SESSION['user_time_zone']);

        return date("Y-m-d H:i:s", $time_value);
    }

    function float_regular($money)
    {
        $money+=0.004;
        $money=round($money, 2);
        return $money;
    }

    function result_empty($result)
    {
        $cnt=0;

        if (!is_bool($result))
        foreach($result as $row) 
        {
            $cnt=$cnt+1;
            break;
        }
        return ($cnt==0);
    }

    function print_hdr() 
    {
        echo "<TABLE cellSpacing=0 cellPadding=0 width='90%' align=center border=0><TBODY><TR>";
        echo "<TH width='20%'><a href='/'>返回首页</a></TH>";
        echo "<TH width='60%'></TH>";
        echo "<TH width='20%'>";
        if(!user_has_login()) 
        {
            echo "<a href='/cgi-bin/login_ui.php'>登陆?</a>";
        }
        else
        {
            echo "<a href='/cgi-bin/mtn_user_ui.php'>".$_SESSION['real_name']."</a>&nbsp;&nbsp;<a href='/cgi-bin/login_ui.php'>注销</a>";
        }
        echo "</TH>";
        echo "</TR></TBODY></TABLE><br>";
    }

    function print_hdr_user() 
    {
        echo "<TABLE cellSpacing=0 cellPadding=0 width='90%' align=center border=0><TBODY><TR>";
        echo "<TH width='20%'></TH>";
        echo "<TH width='60%'></TH>";
        echo "<TH width='20%'>";

        echo $_SESSION['user_name']."&nbsp;&nbsp;<a href='/cgi-bin/login_ui.php'>注销</a>";

        echo "</TH>";
        echo "</TR></TBODY></TABLE><br>";
    }

    function print_bottom_user() 
    {
        echo "<br><br>";
        echo "<center><a href='/'>返回首页</a></center>";
        echo "<br><hr>";
        echo "<h3>小兵投票</h3>";
    }

    function build_id_unit($id_building, $no_unit) 
    {
        return $id_building*10+$no_unit;
    }

    function build_id_col($id_building, $no_unit, $no_col) 
    {
        return $id_building*100+$no_unit*10+$no_col;
    }

    function build_id_room($id_building, $no_unit, $no_col, $floor) 
    {
        return $id_building*10000+$no_unit*1000+$no_col*100+$floor;
    }

    function property_type_n2str($n)
    {
        if ($n==1)
            return "公司";
    }

    function property_type_str2n($str)
    {
        if ($str=="公司")
            return 1;
    }

    function use_right_type_n2str($n)
    {
        if ($n==1)
            return "公司";

        if ($n==2)
            return "部门";

        if ($n==3)
            return "个人";
    }

    function use_right_type_str2n($str)
    {
        if ($str=="公司")
            return 1;

        if ($str=="部门")
            return 2;

        if ($str=="个人")
            return 3;
    }
?>